<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;
use App\User;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
    	$editor_permission = Permission::where('slug','create-post')->first();
		$super_admin_permission = Permission::where('slug', 'edit-post')->first();
		$reader_permission=Permission::where('slug','read-post')->first();

		//creating roles
		//editor role
		$editor_role = new Role();
		$editor_role->slug = 'editor';
		$editor_role->name = 'Editor';
		$editor_role->save();
		$editor_role->permissions()->attach($editor_permission);

		//admin role
		$admin_role = new Role();
		$admin_role->slug = 'admin';
		$admin_role->name = 'Admin';
		$admin_role->save();
		$admin_role->permissions()->attach($super_admin_permission);

		//reader role
		$reader_role = new Role();
		$reader_role->slug = 'reader';
		$reader_role->name = 'Reader';
		$reader_role->save();
		$reader_role->permissions()->attach($reader_permission);


		$editor_role = Role::where('slug','editor')->first();
		$admin_role = Role::where('slug', 'admin')->first();
		$reader_role=Role::where('slug','reader')->first();

		//creating prmissions for role
		$createPosts = new Permission();
		$createPosts->slug = 'create-post';
		$createPosts->name = 'Create Post';
		$createPosts->save();
		$createPosts->roles()->attach($editor_role);

		$editPosts = new Permission();
		$editPosts->slug = 'edit-post';
		$editPosts->name = 'Edit Post';
		$editPosts->save();
		$editPosts->roles()->attach($admin_role);

		$readPosts = new Permission();
		$readPosts->slug = 'read-post';
		$readPosts->name = 'Read Post';
		$readPosts->save();
		$readPosts->roles()->attach($reader_role);

		$editor_role = Role::where('slug','editor')->first();
        $admin_role = Role::where('slug', 'admin')->first();
        $reader_role=Role::where('slug','reader')->first();
		$editor_perm = Permission::where('slug','create-post')->first();
        $admin_perm = Permission::where('slug','edit-post')->first();
        $reader_perm = Permission::where('slug','read-post')->first();
        

        //creating users
        $admin = new User();
		$admin->name = 'Super Admin';
		$admin->email = 'superadmin@gmail.com';
		$admin->password = bcrypt('superadmin');
		$admin->save();
		$admin->roles()->attach($admin_role);
		$admin->permissions()->attach($admin_perm);

		$editor = new User();
		$editor->name = 'Editor';
		$editor->email = 'editor@gmail.com';
		$editor->password = bcrypt('editor');
		$editor->save();
		$editor->roles()->attach($editor_role);
		$editor->permissions()->attach($editor_perm);

		$reader = new User();
		$reader->name = 'Reader';
		$reader->email = 'reader@gmail.com';
		$reader->password = bcrypt('reader');
		$reader->save();
		$reader->roles()->attach($reader_role);
		$reader->permissions()->attach($reader_perm);

		

    }
}
