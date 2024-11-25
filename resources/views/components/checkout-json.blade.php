@php
$checkouts = [
    [
        'id' => '1234',
        'items' => [
            [
                'id' => 1,
                'name' => 'Gaming Laptop',
                'price' => 199.99,
                'quantity' => 1
            ],
            [
                'id' => 2,
                'name' => 'Smartphone',
                'price' => 99.99,
                'quantity' => 1
            ]
        ],
        'itemCount' => 2,
        'total' => 299.98,
        'time' => 'Just now',
        'created_at' => '2024-01-20T14:30:00',
        'status' => 'delivered'
    ],
    [
        'id' => '1234',
        'items' => [
            [
                'id' => 1,
                'name' => 'Gaming Laptop',
                'price' => 199.99,
                'quantity' => 1
            ],
            [
                'id' => 2,
                'name' => 'Smartphone',
                'price' => 99.99,
                'quantity' => 1
            ]
        ],
        'itemCount' => 2,
        'total' => 299.98,
        'time' => 'Just now',
        'created_at' => '2024-01-20T14:30:00',
        'status' => 'delivered'
    ],
    [
        'id' => '1234',
        'items' => [
            [
                'id' => 1,
                'name' => 'Gaming Laptop',
                'price' => 199.99,
                'quantity' => 1
            ],
            [
                'id' => 2,
                'name' => 'Smartphone',
                'price' => 99.99,
                'quantity' => 1
            ]
        ],
        'itemCount' => 2,
        'total' => 299.98,
        'time' => 'Just now',
        'created_at' => '2024-01-20T14:30:00',
        'status' => 'delivered'
    ],
    [
        'id' => '1234',
        'items' => [
            [
                'id' => 1,
                'name' => 'Gaming Laptop',
                'price' => 199.99,
                'quantity' => 1
            ],
            [
                'id' => 2,
                'name' => 'Smartphone',
                'price' => 99.99,
                'quantity' => 1
            ]
        ],
        'itemCount' => 2,
        'total' => 299.98,
        'time' => 'Just now',
        'created_at' => '2024-01-20T14:30:00',
        'status' => 'delivered'
    ],
    [
        'id' => '1234',
        'items' => [
            [
                'id' => 1,
                'name' => 'Gaming Laptop',
                'price' => 199.99,
                'quantity' => 1
            ],
            [
                'id' => 2,
                'name' => 'Smartphone',
                'price' => 99.99,
                'quantity' => 1
            ]
        ],
        'itemCount' => 2,
        'total' => 299.98,
        'time' => 'Just now',
        'created_at' => '2024-01-20T14:30:00',
        'status' => 'delivered'
    ],
    [
        'id' => '1234',
        'items' => [
            [
                'id' => 1,
                'name' => 'Gaming Laptop',
                'price' => 199.99,
                'quantity' => 1
            ],
            [
                'id' => 2,
                'name' => 'Smartphone',
                'price' => 99.99,
                'quantity' => 1
            ]
        ],
        'itemCount' => 2,
        'total' => 299.98,
        'time' => 'Just now',
        'created_at' => '2024-01-20T14:30:00',
        'status' => 'delivered'
    ]
];
@endphp

<div class="max-h-[300px] overflow-y-auto pr-2 space-y-4 custom-scrollbar">
    @foreach($checkouts as $checkout)
        <x-checkout-card 
            :orderNumber="$checkout['id']"
            :itemCount="$checkout['itemCount']"
            :total="$checkout['total']"
            :time="$checkout['time']"
            :items="collect($checkout['items'])->pluck('name')->join(', ')"
        />
    @endforeach
</div>
