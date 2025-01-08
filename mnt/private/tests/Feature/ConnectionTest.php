<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConnectionTest extends TestCase
{   

    private $path = "http://localhost";


    /**
     * Test redirection to the appropritate url.
     *
     * @return void
     */
    public function test_redirect()
    {   
        
        //test director
        $response = $this->withSession(['id' => 1, '' => DB::select('select * from FORMATION where clu_id = 1 and datediff(sysdate(), for_annee) between 0 and 365.25')])->get('/login');
        



        echo var_dump($_SESSION);
        echo url()->current();
        $this->assertTrue($this->path . '/director_panel' == url()->current(), "failed to redirect director");

        $response->assertStatus(200);
    }
}
