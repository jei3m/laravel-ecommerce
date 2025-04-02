<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $recentOrders = Order::where('user_id', $user->id)
            ->with(['items.product'])
            ->latest()
            ->paginate(5);

        $orderItemCount = Order::where('user_id', $user->id)
            -> where('order_status', 'completed')
            -> count();    

        return view('profile.index', [
            'user' => $user,
            'recentOrders' => $recentOrders,
            'orderItemCount' => $orderItemCount,
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Update the user's address.
     */
    public function updateAddress(Request $request)
    {
        try {
            Log::info('Address update request received', [
                'all_data' => $request->all(),
                'headers' => $request->headers->all()
            ]);
            
            $validated = $request->validate([
                'street_address' => 'nullable|string|max:255',
                'barangay' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'province' => 'nullable|string|max:255',
                'region' => 'nullable|string|max:255',
                'region_code' => 'nullable|string|max:50',
                'province_code' => 'nullable|string|max:50',
                'city_code' => 'nullable|string|max:50',
                'barangay_code' => 'nullable|string|max:50'
            ]);

            Log::info('Validated data:', $validated);

            $user = Auth::user();
            Log::info('Current user data:', $user->toArray());
            
            // Remove null and empty string values from validated data
            $validated = array_filter($validated, function($value) {
                return !is_null($value) && $value !== '';
            });
            
            Log::info('Filtered data for update:', $validated);
            
            try {
                $updated = $user->update($validated);
                Log::info('Update operation result:', ['success' => $updated]);
            } catch (\Exception $e) {
                Log::error('Database update error:', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                throw $e;
            }

            if (!$updated) {
                throw new \Exception('Failed to update user address');
            }

            return response()->json([
                'success' => true,
                'message' => 'Address updated successfully',
                'data' => $validated
            ]);
        } catch (\Exception $e) {
            Log::error('Address update error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            $statusCode = $e instanceof \Illuminate\Validation\ValidationException ? 422 : 500;
            $errors = $e instanceof \Illuminate\Validation\ValidationException 
                ? $e->errors() 
                : ['error' => $e->getMessage()];

            return response()->json([
                'success' => false,
                'message' => 'Failed to update address: ' . $e->getMessage(),
                'errors' => $errors
            ], $statusCode);
        }
    }
}
