<!DOCTYPE html>
<html lang="en">
	<head>

        <?php
        include('nav.php');
        echo $extLinks;
        ?>

    </head>

    <body class="d-flex flex-column min-vh-100">

        <?php
        echo $navigation;
        ?>

        <div class="container">
            <div class="row">
                <div class="col-6 align-self-start welcometext">
                    <h1>Welcome to StayFit!</h1>
                </div>
                <div class="col-6 align-self-start text-black-50">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam volutpat, ligula eu tempor gravida, 
                        mauris quam rhoncus urna, ac accumsan justo velit non dolor. Morbi vitae orci accumsan enim 
                        dignissim imperdiet at ut felis. In lorem elit, pretium id risus ac, dapibus tempus velit. 
                        Mauris non ex sit amet diam congue lacinia. Suspendisse potenti. Sed eu dignissim enim. Morbi 
                        viverra turpis at augue tempor molestie. In id consequat sem.
                    </p>

                    <p>
                        Sed ornare auctor massa, eu mollis dolor porttitor sed. Ut suscipit ipsum sit amet enim ultricies 
                        pellentesque. Phasellus nec hendrerit nunc. Aenean et sem quis lorem varius sollicitudin. Etiam 
                        accumsan finibus nisl, nec pellentesque nibh dignissim nec. Phasellus pretium velit non ante porta 
                        tristique. Cras felis neque, varius ac dolor eu, accumsan ultrices dolor. Curabitur eu commodo sem, 
                        non luctus lorem. Aliquam vestibulum semper arcu posuere semper. Mauris vel congue leo, id tempor 
                        leo. Vestibulum eget dictum lorem, vitae sodales risus. Donec ornare, risus et iaculis elementum, 
                        ipsum elit consequat ex, sit amet aliquet erat quam laoreet quam. Quisque ornare nisi lectus, quis 
                        cursus risus fermentum ut. Cras ac ultricies nisl. Suspendisse vulputate massa ac nisi mollis, sit 
                        amet congue dui porttitor. Phasellus et porta arcu.
                    </p>
                </div>
            </div>
        </div>
        
    </body>
    <?php
        include("footer.php")
    ?>
</html>