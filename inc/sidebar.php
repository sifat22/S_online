<div class="header_bottom">
    <div class="header_bottom_left">
        <div class="section group">
        <!--get iphone-->
        <?php 
        
            $getiphone=$pro->latestFromIphone();
            if($getiphone){
                while($result=$getiphone->fetch_assoc()){

             
        
        ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?productid=<?php echo $result['productId']; ?>"> <img style="height: 150px; width:80px;" src="admin/<?php echo $result['image']; ?>" class="img-responsive" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>Apple</h2>
                    <p><?php echo $result['productName']; ?></p>
                    <div class="button"><span><a href="details.php?productid=<?php echo $result['productId']; ?>"> Add to cart</a></span></div>
                </div>
            </div>
                <?php } } ?>
                 <!--get iphone-->
        <?php 
        
        $getiphone=$pro->latestFromSamsung();
        if($getiphone){
            while($result=$getiphone->fetch_assoc()){

         
    
    ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?productid=<?php echo $result['productId']; ?>"><img style="height: 150px; width:80px;" src="admin/<?php echo $result['image']; ?>" src="admin/<?php echo $result['image']; ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>Samsung</h2>
                    <p><?php echo $result['productName']; ?></p>
                    <div class="button"><span><a href="details.php?productid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
                </div>
            </div>
            <?php } } ?>
        </div>

        <div class="section group">
        <?php 
        
        $getiphone=$pro->latestFromAcer();
        if($getiphone){
            while($result=$getiphone->fetch_assoc()){

         
    
    ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?productid=<?php echo $result['productId']; ?>"> <img style="height: 150px; width:180px;" src="admin/<?php echo $result['image']; ?>" src="admin/<?php echo $result['image']; ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>Acer</h2>
                    <p><?php echo $result['productName']; ?></p>
                    <div class="button"><span><a href="details.php?productid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
                </div>
            </div>
            <?php } } ?>
            <?php 
        
        $getiphone=$pro->latestFromCanon();
        if($getiphone){
            while($result=$getiphone->fetch_assoc()){

         
    
    ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?productid=<?php echo $result['productId']; ?>"><img style="height: 150px; width:80px;" src="admin/<?php echo $result['image']; ?>" src="admin/<?php echo $result['image']; ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>Canon</h2>
                    <p><?php echo $result['productName']; ?></p>
                    <div class="button"><span><a href="details.php?productid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
                </div>
            </div>
            <?php } } ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="header_bottom_right_images">
        <!-- FlexSlider -->

        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <li><img src="images/1.jpg" alt="" /></li>
                    <li><img src="images/2.jpg" alt="" /></li>
                    <li><img src="images/3.jpg" alt="" /></li>
                    <li><img src="images/4.jpg" alt="" /></li>
                </ul>
            </div>
        </section>
        <!-- FlexSlider -->
    </div>
    <div class="clear"></div>
</div>