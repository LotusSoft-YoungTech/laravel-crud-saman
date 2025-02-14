<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminPostControllerTest extends TestCase
{
    use RefreshDatabase;
   /**
     * A basic test example.
     */
    public function test_homepage_contain_empty_table(): void
    {
        $admin = Admin::factory()->create();

        // Authenticate as the admin user
        $this->actingAs($admin, 'admin'); 
   
        $response = $this->get('/admin/dashboard');

        $response->assertSee('No posts available');   
    }
      public function test_admin_can_delete_the_post_of_the_user():void{
        $admin = Admin::factory()->create();
        $user = User::factory()->create(); 
        $post = Post::factory()->create([
            'user_id' => $user->id,
        ]);
        $this->actingAs($admin,'admin');
        $response = $this->delete(route('admin.posts.destroy', $post->id));
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);

        $response->assertRedirect(route('admin.dashboard'));
        $response->assertSessionHas('success', 'Post deleted successfully.');

      }  
      public function test_admin_can_restrict_the_user_post():void{

        $admin=Admin::factory()->create();
        $user=User::factory()->create();
        $post=Post::factory()->create([
           'user_id'=>$user->id,
        ]);
        $this->actingAs($admin,'admin');
     $response=$this->post(route('admin.posts.restrict',$post->id));
     $response->assertSessionHas('success', 'Post status updated successfully.');
      }
      public function test_admin_can_login_after_register():void{
        $admin=Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $response=$this->get(route('admin.dashboard'));
        $response->assertSee(200);
      }
     Public function test_admin_can_register():void{
        $adminData = [
            'name' => 'Test Admin',
            'email' => 'admin@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];
    

        $response = $this->post(route('admin.register'), $adminData);
    
      
        $response->assertRedirect(route('admin.dashboard'));
    
        
        $this->assertDatabaseHas('admins', [
            'email' => 'admin@test.com',
        ]);
     }
}
