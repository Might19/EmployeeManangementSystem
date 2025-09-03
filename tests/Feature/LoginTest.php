<?php
test('login page is working', function () {
    $response = $this->get('/login');
    $response->assertStatus(200);
});