<?php

use Illuminate\Database\Eloquent\Model;
use Naykel\Gotime\Casts\FloatAsInteger;

beforeEach(function () {
    $this->model = new class extends Model
    {
        protected $fillable = ['test_attribute'];
    };
    $this->cast = new FloatAsInteger; // Default 2 decimals
});

it('converts float to integer on set', function () {
    $result = $this->cast->set($this->model, 'price', 19.99, []);
    expect($result)->toBe(1999);
});

it('converts integer to float on get', function () {
    $result = $this->cast->get($this->model, 'price', 1999, []);
    expect($result)->toBe(19.99);
});

it('rounds values correctly', function () {
    $setResult = $this->cast->set($this->model, 'price', 19.999, []);
    expect($setResult)->toBe(2000); // 19.999 rounds to 20.00
});

it('handles zero values correctly', function () {
    $setResult = $this->cast->set($this->model, 'price', 0.00, []);
    $getResult = $this->cast->get($this->model, 'price', 0, []);

    expect($setResult)->toBe(0);
    expect($getResult)->toBe(0.0);
});

it('handles null values correctly', function () {
    $setResult = $this->cast->set($this->model, 'price', null, []);
    $getResult = $this->cast->get($this->model, 'price', null, []);

    expect($setResult)->toBeNull();
    expect($getResult)->toBeNull();
});

it('converts values correctly with different decimal precision', function () {
    $testCases = [
        // [decimals, float_value, expected_integer]
        [2, 19.99, 1999],
        [2, 0.00, 0],
        [2, -19.99, -1999],
        [3, 1.925, 1925],
        [3, 12.345, 12345],
        [4, 0.8532, 8532],
        [4, 12.3456, 123456],
        [4, 0.0001, 1],
    ];

    foreach ($testCases as [$decimals, $floatValue, $expectedInteger]) {
        $cast = new FloatAsInteger($decimals);

        // Test set (float to integer)
        $setResult = $cast->set($this->model, 'value', $floatValue, []);
        expect($setResult)->toBe($expectedInteger);

        // Test get (integer back to float)
        $getResult = $cast->get($this->model, 'value', $expectedInteger, []);
        expect($getResult)->toBe($floatValue);
    }
});

it('prevents floating point precision errors', function () {
    $cast = new FloatAsInteger(2);

    // Store as integers
    $stored1 = $cast->set($this->model, 'val', 0.1, []);
    $stored2 = $cast->set($this->model, 'val', 0.2, []);

    expect($stored1)->toBe(10);
    expect($stored2)->toBe(20);

    // Retrieve precisely
    expect($cast->get($this->model, 'val', 10, []))->toBe(0.1);
    expect($cast->get($this->model, 'val', 20, []))->toBe(0.2);

    // Mathematical operations work with integers
    $integerSum = $stored1 + $stored2;
    $floatSum = $cast->get($this->model, 'val', $integerSum, []);
    expect($floatSum)->toBe(0.3);
});
