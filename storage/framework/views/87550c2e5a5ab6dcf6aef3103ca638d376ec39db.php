
<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <form method="POST" action="<?php echo e(url('/addTodo')); ?>" class="row">

            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

            <div class="col-sm-9 form-group">
                <label class="font-weight-bold" for="todo_title">Yapılacak İş</label>
                <input type="text" class="form-control" name="todo_title" id="todo_title" placeholder="Yapılacak İş">
            </div>
            <div class="col-sm-3 m-auto">
                <button class="btn btn-dark mt-3 w-100">Ekle</button>
            </div>
        </form>
        <table class="table table-striped table-inverse  w-100">
            <thead class="thead-inverse">
                <tr>
                    <th>ID</th>
                    <th class="text-center">İş Adı</th>
                    <th class="text-center">Durum</th>
                    <th>Sil</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $todo_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td scope="row">#<?php echo e($key + 1); ?></td>
                        <td class="text-center"><?php echo e($value->title); ?></td>
                        <td class="text-center">
                            <input type="checkbox" id="changeButton" class="w-100 changeButton"
                                data-id="<?php echo e($value->id); ?>" <?php echo e($value->status == 1 ? 'checked' : ''); ?>

                                data-toggle="toggle">
                        </td>
                        <td><a href="<?php echo e(url('/deleteTodo/' . $value->id)); ?>" class="btn btn-danger w-100">Sil</a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
        </table>
    </div>

    <script>
        $(function() {
            $('.changeButton').bootstrapToggle({
                on: 'Tamamlandı',
                off: 'Tamamlanmadı'
            });
            $('.changeButton').change((e) => {
                var id = e.target.dataset.id;
                fetch(`/changeStatusTodo/${id}`);
            });
            let searchParams = new URLSearchParams(window.location.search)
            if (searchParams.get("qo") == "error") {
                swal({
                    title: "Hata!",
                    text: "Lütfen boş birşey göndermeyin!",
                    icon: "error",
                });
            }

        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\nuevo\Desktop\todolist\resources\views/home.blade.php ENDPATH**/ ?>