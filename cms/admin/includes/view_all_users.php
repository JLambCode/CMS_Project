<table class="table table-bordered table-hover">
                           <thead>
                               <tr>
                                   <th>Username</th>
                                   <th>First Name</th>
                                   <th>Last Name</th>
                                   <th>Email</th>
                                   <th>Image</th>
                                   <th>Role</th>
                                   <th>Edit User</th>
                                   <th>Delete User</th>
                               </tr>
                           </thead>
                           <tbody>
                               <?php

                                    find_all_users();

                                    delete_user();

                               ?>
                           </tbody>
                       </table>