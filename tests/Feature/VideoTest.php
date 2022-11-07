<?php

use App\Models\Video;

it('has video index endpoint', function () {
    $response = $this->get('/api/videos');
    $response->assertStatus(200);
});

it('has video show endpoint', function () {
    $videoId = Video::factory()->create()->id;
    $response = $this->get("/api/videos/{$videoId}");
    $response->assertStatus(200);
});

it('has creates video endpoint', function () {
    $response = $this->post('/api/videos', [
        'title' => 'test video',
        'description' => 'test video description',
        'url' => 'http://example.com',
        ]);
    $response->assertStatus(200);
});

it('has video update endpoint', function () {
    $videoId = Video::factory()->create()->id;
    $response = $this->put('/api/videos/' . $videoId, [
        'title' => 'test video',
        'description' => 'test video description',
        'url' => 'http://example.com',
    ]);
    $response->assertStatus(200);
});

it('has video delete endpoint', function () {
    $videoId = Video::factory()->create()->id;
    $response = $this->delete("/api/videos/{$videoId}");
    $response->assertStatus(200);
});
