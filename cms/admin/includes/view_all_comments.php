<table class="table table-bordered table-hover">
                           <thead>
                               <tr>
                                   <th>Author</th>
                                   <th>Comment</th>
                                   <th>Email</th>
                                   <th>Status</th>
                                   <th>Date</th>
                                   <th>In Response To</th>
                                   <th>Approve Comment</th>
                                   <th>Pend Comment</th>
                                   <th>Delete Comment</th>
                               </tr>
                           </thead>
                           <tbody>
                               <?php

                                    find_all_comments();

                                    approve_comment();

                                    pend_comment();

                                    delete_comment();

                               ?>
                           </tbody>
                       </table>