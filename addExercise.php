<!DOCTYPE html>
<html lang="en">

    <head>

    <?php
    include('nav.php');
    echo $extLinks;
    ?>

    <meta charset="utf-8">
    <title>Add Exercise</title>
    </head>



    <body>
        <?php
        echo $navigation
        ?>

        <section id="contact vh-100">
            <div class="container-lg py-5">
                <div class="text-center text-white">
                <h2>Add exercises!</h2>
                <p class="lead text-white-50">Add an exercise below!</p>
                </div>
                <div class="row justify-content-center my-5">
                    <div class="col-lg-6">
                        <form>
                            <label for="name" class="form-label text-white">Name:</label>
                            <input type="text" class="form-control mb-4" id="name" placeholder="e.g. Walk around the block.">
                            <label for="subject" class="form-label text-white ">Pick one of the alternatives below:</label>
                            <select class="form-select" aria-label="Default select example">
                                <option value="1" selected>example 1</option>
                                <option value="2">example 2</option>
                                <option value="3">example 3</option>
                            </select>
                            <div class="form-floating">
                                <textarea id="query" class="form-control" style="height: 140px"></textarea>
                                <label for="query">Your query...</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </body>


</html>