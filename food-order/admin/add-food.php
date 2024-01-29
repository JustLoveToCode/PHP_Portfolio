<?php include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br/><br/>
        <?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <!-- " " basically mean it is submitting at the Same Website Page -->
        <!-- enctype="multipart/form-data": This Attribute wil specify how
        the Form Data will be Encoded before Sending it to the Server -->
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Create the width of 30 on the Table Format -->
            <table class="tbl-30">
            <!-- Creating the Table Row -->
            <tr>
                <td>Title:</td>
                <td>
                    <!-- Create the input text here: -->
                    <input type="text" name="title" placeholder="Title of the Food">
                </td>
            </tr>
            <!-- Creating the Table Row -->
            <tr>
                <td>Description:</td>
                <td>
                    <!-- Creating the textArea Component: -->
                    <textarea name="description" cols="30" rows="10" placeholder="Description of the Food"></textarea>
                </td>
            </tr>
            <!-- Creating the Table Row -->
            <tr>
                <td>Price:</td>
                <td>
                    <!-- Create the Up and Down Arrow -->
                    <input type="number" name="price">
                </td>
            </tr>
            <!-- Creating the Table Row -->
            <tr>
                <td>Select Image:</td>
                <td>
                    <!-- Create Upload for the file -->
                    <input type="file" name="image">
                </td>
            </tr>
            <!-- Creating the Table Row -->
            <tr>
                <td>Category:</td>
                <td>
                    <!-- select tab will create the DropDown Options -->
                    <select name="category">
                    <?php
                    // Create PHP Code to display Category from DataBase 
                    // Create SQL Query to get all the Active Category from the DataBase in the MySQL DataBase:
                    // Using the WHERE keyword for the Criteria Selection:
                    $sql ="SELECT * FROM tbl_category WHERE active='Yes'";
                    // Execute the Query using mysqli_query Method:
                    $res = mysqli_query($conn, $sql);
                    // Count the Rows to check whether we have Categories or Not:
                    // If the count is greater than 0, we will have the Categories
                    // Else we do not have the Categories:
                    $count = mysqli_num_rows($res);
                    
                    // If the $count is greater than 0: We will have the Data:
                    if($count>0)
                    {
                        // If the count is greater than 0, we will use the while keyword to fetch the Data:
                        // We have the Categories here after extracting from the SQL Query above:
                        // Fetch the Individual Data for the Various rows using the while keyword:
                        // Once the data is 'fetched', stored it in the $row Variable:
                        while($row=mysqli_fetch_assoc($res))
                        {
                            // Get the Details of the Categories from the DataBase:
                            // for the Individual Columns for the 'id' and the 'title' Columns:
                            // and assign it to the $id and the $title respectively:
                            $id = $row['id'];
                            $title=$row['title'];
                            ?>
                            <!-- This will create the String of the $id and the $title Here
                            in the option Value-->
                            <option value="<?php echo $id;?>"><?php echo $title;?></option>
                            <?php
                        }

                    }
                    // If we do not have any Categories, we will
                    // execute the else Statement:
                    else
                    {
                        // We do not have the Categories:
                        ?>
                        <option value="0">No Category Found</option>
                        <?php
                    }
                    // Display on DropDown Menu Itself:
                    ?>
                    </select>

                </td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td>
                    <!-- Since I have given the same name as featured,
                    It mean only 1 option will be selected one at a time -->
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No"> No
                </td>
            </tr>
            <tr>
                <td>Active:</td>
                <td>
                    <!-- Since I have given the same name as active -->
                    <!-- It mean that only 1 option will be selected at a time -->
                    <input type="radio" name="active" value="Yes"> Yes
                    <input type="radio" name="active" value="No"> No
                </td>
            </tr>
            <tr>
                <!-- This will span 2 Columns: -->
                <td colspan="2">
                <!-- This will create the input Component here -->
                    <input type="submit" name="submit" value="Add Food"class="btn-secondary">
                </td>
                <td></td>
            </tr>
            </table>
        </form>

        <?php
        // Check whether the Button is Clicked or Not using the isset Keyword:
        if(isset($_POST['submit']))
        {
            // Add the Food into the DataBase Management in mySQL:
            // 1. Get the Data from Form using the $_POST Method Here:
            // The Column here is 'title', 'description', 'price' and 'category' Variable:
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];


            // Check whether the Radio Button for featured are
            // checked or not using the isset Keyword and assigned it to
            // the $featured Variable:
            if(isset($_POST['featured']))
            {
                $featured = $_POST['featured'];
            }
            else{
                // Setting the Default Value for $featured Variable:
                $featured = "No";
            }
            // Check whether the Radio Button for active are
            // checked or not using the isset Keyword and assigned it to
            // the $active Variable:
            if(isset($_POST['active']))
            {
               $active = $_POST['active'];
            }
            else{
                // Setting the Default Value for $active Variable:
                $active = "No";
            }
            // 2. Upload the Image if it is Selected:
            // Check whether the Selected Image is Clicked or Not:
            // and Upload the Image only if the Image is Selected:
            
            if(isset($_FILES['image']['name']))
            {
                // Get the Details of the Selected Image:
                $image_name=$_FILES['image']['name'];

                // Check whether the Image is Selected or Not and Upload
                // the Image only if it is Selected:
                // The Image is selected:
                    if($image_name!="")
                    {
                        // Image is Selected:
                        // Rename the Image:
                        // Get the Extension of the Selected Image which is .pdf .jpg .png .gif
                        // using the explode '.' and get the vijay-thapa and jpg
                        // end keyword will only select the Last part of the '.' after the '.':
                        $exploded_array = explode('.', $image_name);
                        $ext = end($exploded_array);
                        // Create New Image File Name for the Image using the Below Code
                        // and Concatenate all the Different Lines of the String Together:
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext;
                        // Upload the Image: Get the Src and the Destination Path:
                        // Src is the Current Location Path of the Image:
                        $src = $_FILES['image']['tmp_name'];
                        // Get the Destination Path for the Image to be Uploaded:
                        $dst = "../images/food/".$image_name;

                        // Upload the Image to Manage the Food Page from the src path
                        // to the destination path:
                        $upload = move_uploaded_file($src,$dst);

                        // Check whether the Image is Uploaded or Not:
                        if($upload== false){
                            //Failed to Upload the Image:
                            //Redirect to the Add Food Page with the Error Message:
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload the Image</div>";
                            // This will Redirect to the Following Page Below:
                            header('location:'.SITEURL.'admin/add-page.php');
                            // Stop the Process:
                            die();
                        }
                    }
            }
            // Using the else Statement:
            else{
                // Setting the Default Value as Blank which is  Blank " " Here:
                $image_name = "";
            }
            // 3. Insert into the SQL DataBase:
            // Create the SQL Query to Save or Add Food:
            // For Numerical Value like category_id, we do not need
            // to pass the ' ' inside the Code but for String Value
            // it is Compulsory to add the ' ' here using the INSERT keyword:
            $sql2 ="INSERT into tbl_food SET
            title = '$title',
            description='$description',
            price = '$price',
            image_name = '$image_name',
            category_id = $category,
            featured = '$featured',
            active = '$active'
            ";
            // Execute the Query:
            $res2 = mysqli_query($conn, $sql2);
            // Check whether the Data is Inserted or Not 
            // into the DataBase Management in mySQL Query:
            if($res2==true){
                $_SESSION['add']="<div class='success'>Food Added Successfully</div>";
                echo "<script>window.location.href='http://localhost/food-order/admin/manage-food.php';</script>";
                die();
                
               
            }
            else{
                // Failed to Insert the Data:
                $_SESSION['add']="<div class='error'>Failed to add the Food Data</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }   
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php');?>
<?php ?>

