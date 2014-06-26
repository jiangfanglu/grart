<form action='<?php echo JURI::base() . 'index.php?option=com_grart&view=editFeatured' ?>' method="post" name="feature_form">
    <table class="table-general">
        <thead>
            <tr>

                <th>Artwork_id</th>
                <th>Title</th>                            
                <th>Product_id</th>

                <th>Username</th>
                <th>Email</th>
                <th>Category</th>
                <th>Order</th>

            </tr>
        </thead>

        <tr>

            <td><?php echo $this->artwork_id; ?></td>
            <td><?php echo $this->title; ?></td>
            <td><?php echo $this->product_id; ?></td>
            <td><?php echo $this->username; ?></td>
            <td><?php echo $this->email; ?></td>
            <td><?php echo $this->category_name; ?></td>
            <td><input type="text" name="order" id='order' value="0" /></td>



        </tr>


    </table>
    <div style='width:100%'>

        <h3>Please choose one image for this featured product:</h3>
        <input type='hidden' name='product_id' id="product_id" value='<?php echo $this->product_id; ?>' />
        <input type='hidden' name='category_id' id="category_id" value='<?php echo $this->category_id; ?>' />
        <table> 
            <tr>
                <?php
                $address = "/media/uploaded_artwork/" . $this->user_id->user_id . "/200/";
                foreach ($this->image_files as $image_filename) {
                    ?>


                    <td>
                        <img src='<?php echo $address . $image_filename->filename; ?>' alt='image' />
                        <br /><input type='radio' name='image'  id="image" value='<?php echo $image_filename->id; ?>' />

                    </td>

                <?php }
                ?>
            </tr>        
        </table>

        <input type='submit' name='save_feature' id="save_feature" value="Save this feature" />

    </div>
</form>
