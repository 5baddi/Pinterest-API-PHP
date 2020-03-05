<?php

/**
 * Copyright 2015 Dirk Groenen
 *
 * (c) Dirk Groenen <dirk@bitlabs.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace 5baddi\Pinterest\Tests\Endpoints;

use \5baddi\Pinterest\Pinterest;
use \5baddi\Pinterest\Tests\Utils\CurlBuilderMock;

class FollowingTest extends \PHPUnit\Framework\TestCase
{

    /**
     * The Pinterest instance
     *
     * @var Pinterest
     */
    private $pinterest;

    /**
     * Setup a new instance of the Pinterest class
     *
     * @return void
     */
    public function setUp(): void
    {
        $curlbuilder = CurlBuilderMock::create($this);

        // Setup Pinterest
        $this->pinterest = new Pinterest("0", "0", $curlbuilder);
        $this->pinterest->auth->setOAuthToken("0");
    }

    public function testUsers()
    {
        $response = $this->pinterest->following->users();

        $this->assertInstanceOf("5baddi\Pinterest\Models\Collection", $response);
        $this->assertInstanceOf("5baddi\Pinterest\Models\User", $response->get(0));
    }

    public function testInterests()
    {
        $response = $this->pinterest->following->interests();

        $this->assertInstanceOf("5baddi\Pinterest\Models\Collection", $response);
        $this->assertInstanceOf("5baddi\Pinterest\Models\Interest", $response->get(0));
    }

    public function testBoards()
    {
        $response = $this->pinterest->following->boards();

        $this->assertInstanceOf("5baddi\Pinterest\Models\Collection", $response);
        $this->assertInstanceOf("5baddi\Pinterest\Models\Board", $response->get(0));
    }

    public function testFollowUser()
    {
        $response = $this->pinterest->following->followUser("181692303625162433");

        $this->assertTrue($response);
    }

    public function testUnfollowUser()
    {
        $response = $this->pinterest->following->unfollowUser("181692303625162433");

        $this->assertTrue($response);
    }

    public function testFollowBoard()
    {
        $response = $this->pinterest->following->unfollowBoard("503066289565421201");

        $this->assertTrue($response);
    }

    public function testUnfollowBoard()
    {
        $response = $this->pinterest->following->unfollowBoard("503066289565421201");

        $this->assertTrue($response);
    }

    public function testIfPaginationIsWorking()
    {
        $response = $this->pinterest->following->interests(array(
            "cursor"    => "Pz8wMDA5NzZiMmJmYzYyYmQ5NDE0ZTFkYmMxMzIwMDc2Ynw1N2ZmMGQ4ZGRiZjMxMjQ5YjAwMmY5MGI3ZTI3NTBjNzZmNTQ4ZmFiNjNiOWYxNzE2MjdkNzgxNmMwZDNkNzFi"
        ));

        $this->assertInstanceOf("5baddi\Pinterest\Models\Collection", $response);
        $this->assertInstanceOf("5baddi\Pinterest\Models\Interest", $response->get(0));
        $this->assertEquals($response->get(0)->id, "932253650197");
    }
}
