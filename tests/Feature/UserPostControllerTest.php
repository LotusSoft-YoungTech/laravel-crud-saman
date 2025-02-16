<?php
namespace Tests\Feature;
use App\Models\Admin;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserPostControllerTest extends TestCase
{
  use RefreshDatabase;
  public function test_User_can_register():void{
    $userdata=[
        'name'=>'test user',
        'email'=>'testsubject@gmail.com',
        'password'=>'123123123',
         'password_confirmation' => '123123123'
    ];
    $response=$this->post(route('register'),$userdata);
    $response->assertRedirect('dashboard');
    $this->assertDatabaseHas('users',['email'=>'testsubject@gmail.com']);
  
}
public function test_user_can_login_after_register(): void
{
    $usernew = User::factory()->create();
    $this->actingAs($usernew, 'web');
    $response = $this->get(route('dashboard'));
    $response->assertSee(200);
}
public function test_user_can_post_blog(){
  $user=User::factory()->create();
$postdata=[
  'title'=>'test',
  'content'=>'test'
];
  $this->actingAs($user,'web');
  $response=$this->post(route('post.store'),$postdata);
  $this->assertDatabaseHas('posts', [
      'title' => 'test',
      'content' => 'test',
      'user_id' => $user->id, 
  ]);

}
public function test_user_can_update_his_post(){
$user=User::factory()->create();
$post=Post::factory()->create([
  'user_id' => $user->id,
  'title'=>'testpost1',
  'content'=>'contentest1'
]);
$this->actingAs($user,'web');
$postData = [
  'title' => 'updated title',
  'content' => 'updated content'
];

$response = $this->put(route('posts.update', $post), $postData);
$response->assertRedirect(route('manage')); 
$this->assertDatabaseHas('posts',[
   'title' => 'updated title',
  'content' => 'updated content'
]);
}
Public function test_user_can_like_the_post(){
  $user=User::factory()->create();
  $post=Post::factory()->create([
    'user_id'=>$user->id,
    'title'=>'testtitle',
    'content'=>'testcontent'

  ]);
  $this->actingAs($user,'web');
  $response=$this->post(route('posts.like',$post->id));

  $this->assertDatabaseHas('likes',[
    'user_id'=>$user->id,
    'post_id'=>$post->id
  ]);
}
public function test_usercan_comment_onpost():void{
$user=User::factory()->create();
$post=Post::factory()->create([
  'user_id'=>$user->id,
  'title'=>'testtitle',
  'content'=>'testcontent'

]);
$commnetdata=[
  'comment'=>'this is comment for testing in commnets tables'
];
$this->actingAs($user,'web');
$response=$this->post(route('posts.comment',$post->id),$commnetdata);
$this->assertDatabaseHas('comments',
[
  'user_id' => $user->id,
  'post_id' => $post->id,
 'comment'=>'this is comment for testing in commnets tables'
]);
}
}

