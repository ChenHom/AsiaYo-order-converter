<?php

test('orders 回應成功', function () {
    $this->post('/api/orders', [
        'id' => 'A001',
        'name' => 'Order One',
        'address' => [
            'city' => 'city 1',
            'district' => 'district 1',
            'street' => 'street 1',
        ],
        'price' => 1000,
        'currency' => 'TWD',
    ])
        ->assertStatus(200)
        ->assertJsonStructure([
            'id',
            'name',
            'address' => [
                'city',
                'district',
                'street',
            ],
            'price',
            'currency',
        ])
        ->assertJsonFragment(['price' => 1000, 'currency' => 'TWD']);
});

test('orders 回應成功: Currency 爲 USD 時，會轉換成 TWD 並且 price * 31', function () {
    $this->post('/api/orders', [
        'id' => 'A001',
        'name' => 'Order One',
        'address' => [
            'city' => 'city 1',
            'district' => 'district 1',
            'street' => 'street 1',
        ],
        'price' => 1000,
        'currency' => 'USD',
    ])
        ->assertStatus(200)
        ->assertJsonFragment(['price' => 31000, 'currency' => 'TWD']);
});

test('orders 回應失敗: name 首字母大寫', function () {
    $this->post('/api/orders', [
        'id' => 'A001',
        'name' => 'order one',
        'address' => [
            'city' => 'city 1',
            'district' => 'district 1',
            'street' => 'street 1',
        ],
        'price' => 1000,
        'currency' => 'TWD',
    ])
        ->assertStatus(400)
        ->assertJsonValidationErrors(['name'])
        ->assertJsonFragment(['Name is not capitalized']);
});

test('orders 回應失敗: name 不能有數字', function () {
    $this->post('/api/orders', [
        'id' => 'A001',
        'name' => 'Order 1',
        'address' => [
            'city' => 'city 1',
            'district' => 'district 1',
            'street' => 'street 1',
        ],
        'price' => 1000,
        'currency' => 'TWD',
    ])
        ->assertStatus(400)
        ->assertJsonValidationErrors(['name'])
        ->assertJsonFragment(['Name contains non-English characters']);
});

test('orders 回應失敗: name 不能有符號', function () {
    $this->post('/api/orders', [
        'id' => 'A001',
        'name' => 'Order !',
        'address' => [
            'city' => 'city 1',
            'district' => 'district 1',
            'street' => 'street 1',
        ],
        'price' => 1000,
        'currency' => 'TWD',
    ])
        ->assertStatus(400)
        ->assertJsonValidationErrors(['name'])
        ->assertJsonFragment(['Name contains non-English characters']);
});

test('orders 回應失敗: name 包含非英文的文字', function () {
    $this->post('/api/orders', [
        'id' => 'A001',
        'name' => 'Order 一',
        'address' => [
            'city' => 'city 1',
            'district' => 'district 1',
            'street' => 'street 1',
        ],
        'price' => 1000,
        'currency' => 'TWD',
    ])
        ->assertStatus(400)
        ->assertJsonValidationErrors(['name'])
        ->assertJsonFragment(['Name contains non-English characters']);
});

test('orders 回應失敗: price 大於 200', function () {
    $this->post('/api/orders', [
        'id' => 'A001',
        'name' => 'Order One',
        'address' => [
            'city' => 'city 1',
            'district' => 'district 1',
            'street' => 'street 1',
        ],
        'price' => 3000,
        'currency' => 'TWD',
    ])
        ->assertStatus(400)
        ->assertJsonValidationErrors(['price'])
        ->assertJsonFragment(['Price is over 2000']);
});

test('orders 回應失敗: currency 僅能 USD 或 TWD', function () {
    $this->post('/api/orders', [
        'id' => 'A001',
        'name' => 'Order One',
        'address' => [
            'city' => 'city 1',
            'district' => 'district 1',
            'street' => 'street 1',
        ],
        'price' => 1000,
        'currency' => 'INR',
    ])
        ->assertStatus(400)
        ->assertJsonValidationErrors(['currency'])
        ->assertJsonFragment(['Currency format is wrong']);
});
