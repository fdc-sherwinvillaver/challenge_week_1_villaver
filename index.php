<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: login.php");
    }else if($_SESSION['status'] == 0){
        header("location: firstlogin.php");
    }
 ?>
<head>
    <title>EduStudio</title>
    <?php include('partials/head.php'); ?>
</head>

<body class="fixed-sn white-skin">
    <?php include('partials/nav.php'); ?>
    <!--Main layout-->
    <main class="">

        <div class="container-fluid">

            <!-- First row -->
            <div class="row mb-1">
                
                <div class="col-3">

                    <div class="data-card text-center">
                        <h3>6 104</h3>
                        <p>Sessions</p>
                    </div>

                </div>
                <div class="col-3">

                    <div class="data-card text-center">
                        <h3>420</h3>
                        <p>Pages per session</p>
                    </div>

                </div>
                <div class="col-3">

                    <div class="data-card text-center">
                        <h3>1 785</h3>
                        <p>New Sessions</p>
                    </div>

                </div>
                <div class="col-3">

                    <div class="data-card text-center">
                        <h3>1 890</h3>
                        <p>Users</p>
                    </div>

                </div>

            </div>
            <!-- /.First row -->

            <!--Section: Main Chart-->
            <section class="section">

                <!--Main row-->
                <div class="row">

                    <div class="col-md-12">
                        <!--Card-->
                        <div class="card card-cascade narrower">

                            <!--Admin panel-->
                            <div class="admin-panel">

                                <!--First row-->
                                <div class="row mb-0">

                                    <!--First column-->
                                    <div class="col-md-5">

                                        <!--Panel title-->
                                        <div class="view left primary-color">
                                            <h2>Traffic</h2>
                                        </div>
                                        <!--/Panel title-->

                                        <!--Panel data-->
                                        <div class="row card-block pt-3">

                                            <!--First column-->
                                            <div class="col-md-12">

                                                <!--Date select-->
                                                <h4><span class="badge big-badge primary-color">Data range</span></h4>
                                                <select class="mdb-select">
                                                    <option value="" disabled selected>Choose time period</option>
                                                    <option value="1">Today</option>
                                                    <option value="2">Yesterday</option>
                                                    <option value="3">Last 7 days</option>
                                                    <option value="3">Last 30 days</option>
                                                    <option value="3">Last week</option>
                                                    <option value="3">Last month</option>
                                                </select>
                                                <br>

                                                <!--Date pickers-->
                                                <h4><span class="badge big-badge primary-color">Custom date</span></h4>
                                                <br>
                                                <div class="md-form d-inline-block">
                                                    <input placeholder="Selected date" type="text" id="from" class="form-control datepicker">
                                                    <label for="date-picker-example">From</label>
                                                </div>
                                                <div class="md-form d-inline-block float-md-right">
                                                    <input placeholder="Selected date" type="text" id="to" class="form-control datepicker">
                                                    <label for="date-picker-example">To</label>
                                                </div>

                                            </div>
                                            <!--/First column-->

                                        </div>
                                        <!--/Panel data-->
                                    </div>
                                    <!--/First column-->

                                    <!--Second column-->
                                    <div class="col-md-7">
                                        <!--Cascading element-->
                                        <div class="view right primary-color mb-r">
                                            <!--Main chart-->
                                            <canvas id="traffic" height="155px"></canvas>
                                        </div>
                                        <!--/Cascading element-->
                                    </div>
                                    <!--/Second column-->

                                </div>
                                <!--/First row-->

                            </div>
                            <!--/Admin panel-->

                        </div>
                        <!--/.Card-->
                    </div>

                </div>
                <!--/Main row-->

            </section>
            <!--/Section: Main chart-->

            <!-- Section: data tables -->
            <section class="section">

                <div class="row">
                    <div class="col-md-4">
                        
                        <div class="card mb-r">
                            <div class="card-block">
                                <h4 class="h4-responsive text-center mb-1">
                                    Visits by Browser
                                </h4>

                                <canvas id="seo"></canvas>
                            </div>
                        </div>
                        <div class="card mb-r">
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="table large-header">
                                        <thead>
                                            <tr>
                                                <th>Keywords</th>
                                                <th>Visits</th>
                                                <th>Pages</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Material Design</td>
                                                <td>15</td>
                                                <td>307</td>
                                            </tr>
                                            <tr>
                                                <td>Bootstrap</td>
                                                <td>32</td>
                                                <td>504</td>
                                            </tr>
                                            <tr>
                                                <td>MDBootstrap</td>
                                                <td>41</td>
                                                <td>613</td>
                                            </tr>
                                            <tr>
                                                <td>Frontend</td>
                                                <td>14</td>
                                                <td>208</td>
                                            </tr>
                                            <tr>
                                                <td>CSS Framework</td>
                                                <td>24</td>
                                                <td>314</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <button class="btn-flat waves-effect float-right">View full report</button>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-8">
                        <div class="card mb-r">
                            <div class="card-block">
                                <table class="table large-header">
                                    <thead>
                                        <tr>
                                            <th>Country</th>
                                            <th>Visits</th>
                                            <th>Pages</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            
                                            <td>15</td>
                                            <td>307</td>
                                        </tr>
                                        <tr>
                                            
                                            <td>32</td>
                                            <td>504</td>
                                        </tr>
                                        <tr>
                                            
                                            <td>41</td>
                                            <td>613</td>
                                        </tr>
                                        <tr>
                                            
                                            <td>14</td>
                                            <td>208</td>
                                        </tr>
                                        <tr>
                                            
                                            <td>24</td>
                                            <td>314</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <button class="btn-flat waves-effect float-right">View full report</button>

                            </div>

                        </div>

                        <div class="card mb-r">
                            <div class="card-block">
                                <table class="table large-header">
                                    <thead>
                                        <tr>
                                            <th>Browser</th>
                                            <th>Visits</th>
                                            <th>Pages</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Google Chrome</td>
                                            <td>15</td>
                                            <td>307</td>
                                        </tr>
                                        <tr>
                                            <td>Mozilla Firefox</td>
                                            <td>32</td>
                                            <td>504</td>
                                        </tr>
                                        <tr>
                                            <td>Safari</td>
                                            <td>41</td>
                                            <td>613</td>
                                        </tr>
                                        <tr>
                                            <td>Opera</td>
                                            <td>14</td>
                                            <td>208</td>
                                        </tr>
                                        <tr>
                                            <td>Microsoft Edge</td>
                                            <td>24</td>
                                            <td>314</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <button class="btn-flat waves-effect float-right">View full report</button>

                            </div>

                        </div>

                    </div>
                </div>                    

            </section>
            <!-- /.Section: data tables -->


        </div>

    </main>
    <!--/Main layout-->

    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <a class="btn-floating btn-large red">
            <i class="fa fa-pencil"></i>
        </a>

        <ul>
            <li><a class="btn-floating red"><i class="fa fa-star"></i></a></li>
            <li><a class="btn-floating yellow darken-1"><i class="fa fa-user"></i></a></li>
            <li><a class="btn-floating green"><i class="fa fa-envelope"></i></a></li>
            <li><a class="btn-floating blue"><i class="fa fa-shopping-cart"></i></a></li>
        </ul>
    </div>
</body>
    <?php include('partials/scripts.php'); ?>
    <?php include('partials/piechart.php'); ?>
    <script type="text/javascript">
         // Sidenav Initialization
        $(".button-collapse").sideNav();
        var el = document.querySelector('.custom-scrollbar');
        Ps.initialize(el);
    </script>
</html>