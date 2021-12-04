   <!-- Begin Page Content -->
   <div class="container-fluid">
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



     <div class="row">
       <div class="col-lg-6">
         <?= form_error('menu', '<div class="alert alert-danger" 
                role="alert">', '</div>'); ?>

         <?= $this->session->flashdata('message'); ?>

         <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a>

         <table class="table table-hover">
           <thead>
             <tr>
               <th scope="col">#</th>
               <th scope="col">Menu</th>
               <th scope="col">Action</th>
             </tr>
           </thead>
           <tbody>
             <?php $i = 1; ?>
             <?php foreach ($menu as $m) : ?>
               <tr>
                 <th scope="row"><?= $i; ?></th>
                 <td><?= $m['menu']; ?></td>
                 <td>
                   <a href="#" data-toggle="modal" data-target="#modalEdit<?= $m['id']; ?>" class="badge badge-success" data-popup="tooltip" data-placment="top" title="Edit Data">
                     Edit</a>
                   <a href=<?= base_url('menu/delete/') ?><?= $m['id']; ?>" class="badge badge-danger" id="delete" nama="delete">
                     Delete</a>
                 </td>
               </tr>
               <?php $i++; ?>

             <?php endforeach; ?>

           </tbody>
         </table>

       </div>

     </div>


   </div>
   <!-- /.container-fluid -->

   </div>
   <!-- End of Main Content -->

   <!-- modal -->

   <!-- Modal -->
   <div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <form action="<?= base_url('menu'); ?>" method="post">
           <div class="modal-body">
             <div class="form-group">
               <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
             </div>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             <button type="submit" class="btn btn-primary">Add</button>
           </div>
         </form>
       </div>
     </div>
   </div>


   <!-- modal edit -->
   <?php foreach ($menu as $row) : ?>
     <div class="modal fade" id="modalEdit<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="newMen-Label">Edit Menu</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <form action="<?= base_url('menu/editMenu'); ?>" method="post">
             <input type="hidden" readonly value="<?= $row['id']; ?>" name="menu_id" class="form-control">
             <div class="modal-body">
               <div class="form-group">
                 <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name" value="<?= $row['menu']; ?>">
               </div>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Edit</button>
             </div>
           </form>
         </div>
       </div>
     </div>

   <?php endforeach; ?>