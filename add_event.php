<?php

session_start();
require_once './config/config.php';
require_once './includes/auth_validate.php';


//serve POST method, After successful insert, redirect to customers.php page.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Mass Insert Data. Keep "name" attribute in html form same as column name in mysql table.
    $data = filter_input_array(INPUT_POST);
    //Insert timestamp
    $data['created_at'] = date('Y-m-d H:i:s');
    $dbInstance = getDbInstance();
    
    $storedDataId = $dbInstance->insert('customers', $data);

    if ($storedDataId) {
        $_SESSION['success'] = "Customer added successfully!";
        header('location: events.php');
        exit();
    }
}

//We are using same form for adding and editing. This is a create form so declare $edit = false.
$edit = false;

require_once 'includes/header.php';
?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Add Event</h2>
            </div>

        </div>
        <form class="form" action="" method="post"  id="customer_form" enctype="multipart/form-data">
            <?php  include_once('./forms/event_form.php'); ?>
        </form>
    </div>


    <script type="text/javascript">
        $(document).ready(function(){
            $("#event_form").validate({
                rules: {
                    f_name: {
                        required: true,
                        minlength: 3
                    },
                    l_name: {
                        required: true,
                        minlength: 3
                    },
                }
            });
        });
    </script>

<?php include_once 'includes/footer.php'; ?>
