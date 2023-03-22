<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello Bulma!</title>

    <link rel="icon" href="<?php echo base_url('assets/image/logo.svg'); ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma-carousel@4.0.3/dist/css/bulma-carousel.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bulma-modal-fx/dist/css/modal-fx.min.css" /> 
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bulma.min.css"> -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bulma.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<style>
    
</style>

<body>
    <nav class="navbar" role="navigation" aria-label="main navigation"
        style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <div class="navbar-brand">
            <a class="navbar-item" href="<?php echo base_url(); ?>">
                <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false"
                data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <!-- <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        Manage Product
                    </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item">
                            About
                        </a>
                        <a class="navbar-item">
                            Jobs
                        </a>
                        <a class="navbar-item">
                            Contact
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item">
                            Report an issue
                        </a>
                    </div>
                </div> -->
                <a class="navbar-item" id="btn-nav-manage-product">
                    Manage Product
                </a>

                <a class="navbar-item" id="btn-nav-report">
                    Report Product
                </a>
                <a class="navbar-item" id="btn-nav-report-user">
                    Report Employee
                </a>


            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <?php $session = session(); 
                        if(!$session->get('signined')){ ?>
                    <div class="buttons">
                        <a id="btn-nav-signin" class="button is-primary">
                            <strong>Sign in</strong>
                        </a>
                    </div>
                    <?php }else{ ?>
                    <div class="buttons">
                        <a id="btn-nav-signout" onClick="signout()" class="button is-primary">
                            <strong>Sign out</strong>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>
    <div id="signined" data-signined="<?php $session = session(); echo $session->get('signined');?>"
        data-firstname="<?php $session = session(); echo $session->get('firstname');?>" data-url="<?php echo base_url(); ?>"></div>
    <p class="ev_test"></p>
    <p class="ev_test2"></p>
    <p class="ev_test3"></p>
    <section class="section">
        <div class="container is-clipped">
            <div id="slider">
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-16by9 is-covered">
                            <img src="https://images.unsplash.com/photo-1550921082-c282cdc432d6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80"
                                alt="" />
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="item__title">
                            Mon titre 1
                        </div>
                        <div class="item__description">
                            Ici une petite description pour tester le slider
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-image">
                        <figure class="image is-16by9 is-covered">
                            <img src="https://images.unsplash.com/photo-1550945771-515f118cef86?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1000&q=80"
                                alt="" />
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="item__title">
                            Mon titre 2
                        </div>
                        <div class="item__description">
                            Ici une petite description pour tester le slider
                        </div>
                    </div>
                </div>

                 <div class="card">
                    <div class="card-image">
                        <figure class="image is-16by9 is-covered">
                            <img src="https://images.unsplash.com/photo-1550971264-3f7e4a7bb349?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80"
                                alt="" />
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="item__title">
                            Mon titre 3
                        </div>
                        <div class="item__description">
                            Ici une petite description pour tester le slider
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-image">
                        <figure class="image is-16by9 is-covered">
                            <img src="https://images.unsplash.com/photo-1550931937-2dfd45a40da0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80"
                                alt="" />
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="item__title">
                            Mon titre 4
                        </div>
                        <div class="item__description">
                            Ici une petite description pour tester le slider
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-image">
                        <figure class="image is-16by9 is-covered">
                            <img src="https://images.unsplash.com/photo-1550930516-af8b8cc4f871?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1000&q=80"
                                alt="" />
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="item__title">
                            Mon titre 5
                        </div>
                        <div class="item__description">
                            Ici une petite description pour tester le slider
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-image">
                        <figure class="image video-container is-16by9">
                            <iframe type="text/html" src="https://www.youtube.com/embed/H0v773vKS_U"
                                frameborder="0"></iframe>
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="item__title">
                            Mon titre 6
                        </div>
                        <div class="item__description">
                            Ici une petite description pour tester le slider
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container is-clipped">
            <div class="columns is-centered">
                <div class="column has-text-centered is-10">
                    <figure class="image is-square">
                        <img src="https://bulma.io/images/placeholders/128x128.png">
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>
    <div class="modal" id="md-info">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Welcome.</p>
                <button class="delete" data-bulma-modal="close" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <section class="hero is-primary">
                    <div class="hero-body">
                        <div class="container has-text-centered">
                            <h1 class="title has-text-black	">
                                CHOT AIR MOTOR
                            </h1>
                        </div>
                    </div>
                    <div class="hero-foot">
                        <nav class="tabs is-boxed is-fullwidth is-large">
                            <div class="container">
                                <ul>
                                    <li class="tab is-active" id="btn-tabs-signin"
                                        onclick="openTab('btn-tabs-signin','divSignin','md-info')">
                                        <a>Sign in</a>
                                    </li>
                                    <li class="tab" id="btn-tabs-signup"
                                        onclick="openTab('btn-tabs-signup','divSignup','md-info')"><a>Sign
                                            up</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </section>

                <div class="container section">
                    <div id="divSignin" class="content-tab">
                        <div class="columns">
                            <div class="column">
                                <p class="control has-icons-left has-icons-right">
                                    <input class="input is-primary" name="email" id="email-signin" type="email"
                                        placeholder="Email">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <p class="control has-icons-left">
                                    <input class="input is-primary" name="password" id="password-signin" type="password"
                                        placeholder="Password">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div id="divSignup" class="content-tab" style="display:none">
                        <form id="signupform" action="" method="post">
                            <div class="columns">
                                <div class="column">
                                    <p class="control has-icons-left has-icons-right">
                                        <input class="input is-primary" name="firstname" id="firstname" type="text"
                                            placeholder="Firstname">
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <p class="control has-icons-left has-icons-right">
                                        <input class="input is-primary" name="lastname" id="lastname" type="text"
                                            placeholder="Lastname">
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <p class="control has-icons-left has-icons-right">
                                        <input class="input is-primary" name="email" id="email" type="email"
                                            placeholder="Email">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <p class="control has-icons-left">
                                        <input class="input is-primary" name="password" id="password" type="password"
                                            placeholder="Password">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <p class="control has-icons-left">
                                        <input class="input is-primary" name="confirmpassword" id="confirmpassword"
                                            type="password" placeholder="Confirm Password">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <footer class="modal-card-foot buttons is-right">
                <button class="button is-primary is-hovered" type="button" onClick="signin()" id="btn-signin">Sign
                    in</button>
                <button class="button is-primary is-hovered" type="button" onClick="signup()" style="display:none;"
                    id="btn-signup">Sign up</button>
                <button class="button" data-bulma-modal="close">Cancel</button>
            </footer>
        </div>
    </div>
    <div id="md-product" class="modal modal-full-screen modal-fx-fadeInScale">
        <div class="modal-content modal-card">
            <header class="modal-card-head" id="head-modal-manage">
                <p class="modal-card-title">Manage Product</p>
                <button class="delete" data-bulma-modal="close" aria-label="close"></button>
            </header>
            <section class="hero is-primary" id="getFixed">
                <div class="hero-foot">
                    <nav class="tabs is-boxed is-fullwidth is-large">
                        <div class="container">
                            <ul>
                                <li class="tab-manage is-active" id="tabs-type-product"
                                    onclick="openTab('tabs-type-product','type-product','md-product')">
                                    <a>
                                        <span class="icon is-small"><i class="fa fa-list-alt"></i></span>
                                        <span>Type Product</span>
                                    </a>
                                </li>
                                <li class="tab-manage" id="tabs-product"
                                    onclick="openTab('tabs-product','product','md-product')">
                                    <a>
                                        <span class="icon is-small"><i class="fas fa-box-open"></i></span>
                                        <span>Product</span>
                                    </a>
                                </li>
                                <li class="tab-manage" id="tabs-unit"
                                    onclick="openTab('tabs-unit','unit','md-product')">
                                    <a>
                                        <span class="icon is-small"><i class="fab fa-uniregistry"></i></span>
                                        <span>Unit</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </section>
            <section class="modal-card-body" id="nav-tabs-manage">
                <div class="container section" style="padding-left:0px; padding-right:0px;">
                    <div id="type-product" class="content-tab-manage">
                        <div class="columns">
                            <div class="column">
                                <button class="button is-primary is-outlined" id="btn-add-type-product">Add Type
                                    Product</button>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <table id="tbl_type_product" class="table is-striped is-bordered is-hoverable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="product" class="content-tab-manage" style="display:none">
                        <div class="columns">
                            <div class="column">
                                <button class="button is-primary is-outlined" id="btn-add-product">Add Product</button>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <table id="tbl_product" class="table is-striped is-bordered is-hoverable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>image</th>
                                            <th>type</th>
                                            <th>name</th>
                                            <th>quality</th>
                                            <th>unit</th>
                                            <th>update_date</th>
                                            <th>update_by</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="unit" class="content-tab-manage" style="display:none">
                        <div class="columns">
                            <div class="column">
                                <button class="button is-primary is-outlined" id="btn-add-unit">Add Unit</button>
                            </div>
                        </div>
                        <div class="columns is-centered">
                            <div class="column is-12">
                                <table id="tbl_unit" class="table is-striped is-bordered is-hoverable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div id="modal-fall" class="modal modal-fx-fall">
        <div class="modal-background"></div>
        <div class="modal-content">
            <!-- content -->
            <div class="box">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Beatae cum enim quisquam ducimus, facilis,
                esse nesciunt porro,
                officiis totam veniam libero! Nisi hic vel aspernatur doloremque enim ut blanditiis perferendis,
                repudiandae
                assumenda quibusdam delectus quam eum non maxime ullam quod qui ab in dolorem dolores vero amet!
                Perferendis
                incidunt unde blanditiis harum vel velit, accusantium praesentium autem ut voluptas, voluptatibus
                fugiat.
                Molestiae maiores aspernatur expedita, magnam commodi suscipit explicabo labore temporibus tenetur
                distinctio
                mollitia facere eum ad officia? Sit eaque culpa ea saepe facilis. Consequatur, architecto. Optio eveniet
                cupiditate accusantium vero consectetur, maiores eum culpa assumenda reprehenderit sequi aut nihil!
            </div>
            <!-- end content -->
        </div>
        <button class="modal-close is-large" aria-label="close"></button>
    </div>
    <div id="md-add-type-product" class="modal modal-fx-newsPaper ">
        <div class="modal-background"></div>
        <div class="modal-content">
            <!-- content -->
            <div class="box">
                <div>
                    <section class="section">
                        <div class="container">
                            <div id="mode-type-product" data-mode="" data-id-type="" data-id-image="" data-name-type="" data-name-image=""></div>
                            <div class="columns is-centered">
                                <div class="column has-text-centered is-12">
                                    <h4 class="subtitle is-4" id="title-type">New Type Product </h4>
                                </div>
                            </div>
                            <div class="columns is-centered">
                                <div class="column has-text-centered is-12">
                                    <div id="img-preview" class="has-text-centered img-preview"></div>
                                    <div class="file is-primary is-centered ">
                                        <label class="file-label">
                                            <input class="file-input" type="file" id="choose-file" name="resume"
                                                accept="image/*">
                                            <span class="file-cta">
                                                <span class="file-icon">
                                                    <i class="fas fa-upload"></i>
                                                </span>
                                                <span class="file-label">
                                                    Choose Image
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="columns is-centered">
                                <div class="column has-text-centered is-8">
                                    <input class="input is-primary" id="name-type-product" type="text"
                                        placeholder="Type Product Name">
                                </div>
                            </div>
                            <div class="columns is-centered">
                                <div class="column has-text-centered is-8">
                                    <button class="button is-link is-hovered" id="btn-save-type-product"
                                        type="button">Save</button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- end content -->
        </div>
        <button class="modal-close is-large" id="cls-md-new-type-product" aria-label="close"></button>
    </div>
    
    <div id="md-add-unit" class="modal modal-fx-newsPaper ">
        <div class="modal-background"></div>
        <div class="modal-content">
            <!-- content -->
            <div class="box">
                <div>
                    <section class="section">
                        <div class="container">
                            <div id="mode-unit" data-mode="" data-id-unit="" data-name-unit=""></div>
                            <div class="columns is-centered">
                                <div class="column has-text-centered is-12">
                                    <h4 class="subtitle is-4" id="title-unit">New Unit</h4>
                                </div>
                            </div>
                            <div class="columns is-centered">
                                <div class="column has-text-centered is-8">
                                    <input class="input is-primary" id="name-unit" type="text"
                                        placeholder="Unit Name">
                                </div>
                            </div>
                            <div class="columns is-centered">
                                <div class="column has-text-centered is-8">
                                    <button class="button is-link is-hovered" id="btn-save-unit"
                                        type="button">Save</button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- end content -->
        </div>
        <button class="modal-close is-large" id="cls-md-new-unit" aria-label="close"></button>
    </div>
    
    <div id="md-add-product" class="modal modal-fx-newsPaper ">
        <div class="modal-background"></div>
        <div class="modal-content">
            <!-- content -->
            <div class="box">
                <div>
                    <section class="section">
                        <div class="container">
                            <div id="mode-product" data-mode="" data-id-product="" data-name-product=""
                            data-id-type="" data-id-unit="" data-quality-product="" data-name-image="" data-id-image=""
                            ></div>
                            <div class="columns is-centered">
                                <div class="column has-text-centered is-12">
                                    <h4 class="subtitle is-4" id="title-product">New product</h4>
                                </div>
                            </div>
                            <div class="columns is-centered">
                                <div class="column has-text-centered is-12">
                                    <div id="img-preview-pro" class="has-text-centered img-preview"></div>
                                    <div class="file is-primary is-centered ">
                                        <label class="file-label">
                                            <input class="file-input" type="file" id="choose-file-pro" name="resume"
                                                accept="image/*">
                                            <span class="file-cta">
                                                <span class="file-icon">
                                                    <i class="fas fa-upload"></i>
                                                </span>
                                                <span class="file-label">
                                                    Choose Image
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="columns is-centered">
                                <div class="column has-text-centered is-8 is-half">
                                    <div class="field">
                                        <p class="control">
                                            <span class="select is-primary is-fullwidth">
                                                <select id="ddl-type">
                                                </select>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="columns is-centered">
                                <div class="column has-text-centered is-8">
                                    <input class="input is-primary" id="name-product" type="text"
                                        placeholder="Product Name">
                                </div>
                            </div>
                            <div class="columns is-centered" id="div-quality-product">
                                <div class="column has-text-centered is-8">
                                    <input class="input is-primary" id="quality-product" onkeypress="CheckNumber()" type="number"
                                        placeholder="Product Quality">
                                </div>
                            </div>
                            <div class="columns is-centered">
                                <div class="column has-text-centered is-8 is-half">
                                    <div class="field">
                                        <p class="control">
                                            <span class="select is-primary is-fullwidth">
                                                <select id="ddl-unit">
                                                </select>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="columns is-centered">
                                <div class="column has-text-centered is-8">
                                    <button class="button is-link is-hovered" id="btn-save-product"
                                        type="button">Save</button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- end content -->
        </div>
        <button class="modal-close is-large" id="cls-md-new-product" aria-label="close"></button>
    </div>

    <div id="modal-image" class="modal modal-fx-superScaled">
        <div class="modal-background"></div>
        <div class="modal-content is-image">
            <!-- content -->
            <img src="" id="src-md-modal" class="bor-ra-img-modal" alt="Moon">
            <!-- end content -->
        </div>
        <button class="modal-close is-large" aria-label="close"></button>
    </div>

    <div id="md-qua-product" class="modal modal-fx-newsPaper ">
        <div class="modal-background"></div>
        <div class="modal-content">
            <!-- content -->
            <div class="box">
                <div>
                    <section class="section">
                        <div class="container">
                            <div id="mode-qua-product" data-mode="" data-id-product="" data-qua-product="" data-name-product=""></div>
                            <div class="columns is-centered">
                                <div class="column has-text-centered is-12">
                                    <h4 class="subtitle is-4" id="title-qua-product">Add Quality Product</h4>
                                </div>
                            </div>
                            <div class="columns is-centered">
                                <div class="column has-text-centered is-8">
                                    <strong>Quality : <span id="qua-product-txt"></span></strong>
                                </div>
                            </div>
                            <div class="columns is-centered">
                                <div class="column has-text-centered is-8">
                                    <input class="input is-primary" id="qua-product" onkeypress="CheckNumber()" type="text" placeholder="Quality Product...">
                                </div>
                            </div>
                            <div class="columns is-centered">
                                <div class="column has-text-centered is-8">
                                    <button class="button is-link is-hovered" id="btn-save-qua-product"
                                        type="button">Save</button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- end content -->
        </div>
        <button class="modal-close is-large" id="cls-md-qua-product" aria-label="close"></button>
    </div>
    <div id="md-report-product" class="modal modal-full-screen modal-fx-fadeInScale">
        <div class="modal-content modal-card">
            <header class="modal-card-head" id="head-modal-manage">
                <p class="modal-card-title">Report Product</p>
                <button class="delete" data-bulma-modal="close" aria-label="close"></button>
            </header>
            <section class="modal-card-body" >
                <div class="container section" style="padding-left:0px; padding-right:0px;">
                    <div class="columns">
                        <div class="column">
                        <!-- is-bordered -->
                            <table id="tbl_report_product" class="table is-striped is-bordered  is-hoverable" style="width:100%">
                                <thead>
                                    <tr>
                                        <td>No.</td>
                                        <td>Action</td>
                                        <td>Detail</td>
                                        <td>Date</td>
                                        <td>By</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div id="md-report-user" class="modal modal-full-screen modal-fx-fadeInScale">
        <div class="modal-content modal-card">
            <header class="modal-card-head" id="head-modal-manage">
                <p class="modal-card-title">Report User</p>
                <button class="delete" data-bulma-modal="close" aria-label="close"></button>
            </header>
            <section class="modal-card-body" >
                <div class="container section" style="padding-left:0px; padding-right:0px;">
                <div class="columns">
                    <div class="column">
                        <button  type="button" class="button is-danger is-outlined  is-rounded" id="testcheck">Delete All !</button>
                    </div>
                </div>
                    <div class="columns">
                        <div class="column">
                            <table id="tbl_report_user" class="table is-striped is-bordered  is-hoverable" style="width:100%">
                                <thead>
                                    <tr>
                                        <td>No.</td>
                                        <td>Firstname</td>
                                        <td>Lastname</td>
                                        <td>Email</td>
                                        <td>Level</td>
                                        <td>Active</td>
                                        <td>Create_Date</td>
                                        <td>Create_By</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- <button type="button" id="export" onclick="Export_Excel('ok','ExportFile','TestSheet')">Export</button>
    <table id="ok">
        <thead>
            <tr>
                <td>No.</td>
                <td>First</td>
                <td>Last</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>No.</td>
                <td>First</td>
                <td>Last</td>
            </tr>
        </tbody>
    </table> -->

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bulma-carousel@4.0.3/dist/js/bulma-carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js">
    </script>
    <script type="text/javascript" src="https://unpkg.com/bulma-modal-fx/dist/js/modal-fx.min.js"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bulma.min.js"></script> -->

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bulma.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bulma.min.js"></script>
    <!-- <script type="text/javascript" src="<?php echo base_url('assets/js/table-to-excel/dist/tableToExcel.js'); ?>"></script> -->
    <script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
    <script>
        var data_product,data_type,data_unit;
        $(document).ready(function () {
        var signined = $("#signined").attr('data-signined');
            if(signined == true){
                get_product();
                get_type_product();
                get_unit();
                get_report();
                get_user();
            }
            
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "3000",
                "extendedTimeOut": "2000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            // var x = [ 'p0', 'p1', 'p2' ]; 
            // call_me(x);

            // function call_me(params) {
            // for (i=0; i<params.length; i++) {
            //     console.log(params[i])
            // }
            // }
        })
    </script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/index.js'); ?>"></script>

</body>

</html>