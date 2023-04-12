<?php

use Tests\TestCase;

class VacationsApiTest extends TestCase
{
    public function testListNoFilter()
    {
        $response = $this->get('/api/vacations');

        $response->assertStatus(200);
    }

    public function testListNoResponse()
    {
        $response = $this->get('/api/vacations&price[eq]=-1');

        $response->assertStatus(404);
    }

    public function testCreateUpdateGetAndDelete()
    {
        $response = $this->post('/api/vacations', [
            "start" => "2023-04-12T12:00:00",
            "end" => "2023-04-28T12:00:00",
            "price" =>  123.55
        ]);

        $response->assertStatus(201);
        $responseContent = json_decode($response->getContent());

        $updateResponse = $this->put('/api/vacations/' . $responseContent->id, [
            "start" => "2023-04-12T12:00:00",
            "end" => "2023-04-28T12:00:00",
            "price" =>  123.45
        ]);
        $updateResponse->assertStatus(200);

        $getResponse = $this->get('/api/vacations/' . $responseContent->id);
        $getResponse->assertStatus(200);

        $getResponseContent = json_decode($getResponse->getContent());
        $this->assertEquals($getResponseContent->price, 123.45);

        $deleteResponse = $this->delete('/api/vacations/' . $responseContent->id);
        $deleteResponse->assertStatus(200);
    }
}
