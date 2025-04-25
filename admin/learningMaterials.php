<?php require_once "../includes/adminHeader.php" ?>
    <main class="adminmain">
        <div class="section no-pad-bot" id="index-banner">
            <div class="row">
                <div class="col s10 m6 l12">
                    <h5 class="breadcrumbs-title">Learning Materials</h5>
                </div>
                <div class="row">
                    <form>
                        <div class="input-field col s12 m12 l4">
                            <input id="first_name" type="text" class="validate search-box">
                            <label for="first_name" class="serach-label">Search learning Materials...</label>
                        </div>
                        <div class="input-field col s12 m12 l3">
                            <select class="browser-default">
                                <option value="" disabled selected>Select Tutor</option>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                                <option value="3">Option 3</option>
                            </select>
                        </div>
                        <div class="input-field col s12 m12 l3">
                            <select class="browser-default">
                                <option value="" disabled selected>Select Subject</option>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                                <option value="3">Option 3</option>
                            </select>
                        </div>
                        <div class="input-field col s12 m12 l2">
                            <button class="btn waves-effect waves-light" type="submit" name="action">Search
                                <i class="material-icons right">search</i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <div class="direction-top">
                                    <a title="Add Leaning Material" href="learningMaterialAdd.php" class="btn-floating btn-large green floatright">
                                        <i class="large material-icons">add</i>
                                    </a>
                                </div>
                                <table class="responsive-table">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Tutor</th>
                                        <th>Subject</th>
                                        <th>Uploaded On</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Maths Tricks</td>
                                        <td>Marks Smith</td>
                                        <td>Maths</td>
                                        <td>24-Feb-2020 4:10PM</td>
                                        <td>
                                            <a href=""><i class="material-icons green-text">file_download</i></a>
                                            <a href=""><i class="material-icons blue-text">create</i></a>
                                            <a href=""><i class="material-icons red-text">delete</i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Maths Tricks</td>
                                        <td>Marks Smith</td>
                                        <td>Maths</td>
                                        <td>24-Feb-2020 4:10PM</td>
                                        <td>
                                            <a href=""><i class="material-icons green-text">file_download</i></a>
                                            <a href=""><i class="material-icons blue-text">create</i></a>
                                            <a href=""><i class="material-icons red-text">delete</i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Maths Tricks</td>
                                        <td>Marks Smith</td>
                                        <td>Maths</td>
                                        <td>24-Feb-2020 4:10PM</td>
                                        <td>
                                            <a href=""><i class="material-icons green-text">file_download</i></a>
                                            <a href=""><i class="material-icons blue-text">create</i></a>
                                            <a href=""><i class="material-icons red-text">delete</i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Maths Tricks</td>
                                        <td>Marks Smith</td>
                                        <td>Maths</td>
                                        <td>24-Feb-2020 4:10PM</td>
                                        <td>
                                            <a href=""><i class="material-icons green-text">file_download</i></a>
                                            <a href=""><i class="material-icons blue-text">create</i></a>
                                            <a href=""><i class="material-icons red-text">delete</i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Maths Tricks</td>
                                        <td>Marks Smith</td>
                                        <td>Maths</td>
                                        <td>24-Feb-2020 4:10PM</td>
                                        <td>
                                            <a href=""><i class="material-icons green-text">file_download</i></a>
                                            <a href=""><i class="material-icons blue-text">create</i></a>
                                            <a href=""><i class="material-icons red-text">delete</i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Maths Tricks</td>
                                        <td>Marks Smith</td>
                                        <td>Maths</td>
                                        <td>24-Feb-2020 4:10PM</td>
                                        <td>
                                            <a href=""><i class="material-icons green-text">file_download</i></a>
                                            <a href=""><i class="material-icons blue-text">create</i></a>
                                            <a href=""><i class="material-icons red-text">delete</i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Maths Tricks</td>
                                        <td>Marks Smith</td>
                                        <td>Maths</td>
                                        <td>24-Feb-2020 4:10PM</td>
                                        <td>
                                            <a href=""><i class="material-icons green-text">file_download</i></a>
                                            <a href=""><i class="material-icons blue-text">create</i></a>
                                            <a href=""><i class="material-icons red-text">delete</i></a>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                                <ul class="pagination">
                                    <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a>
                                    </li>
                                    <li class="red"><a href="#!">1</a></li>
                                    <li class="waves-effect"><a href="#!">2</a></li>
                                    <li class="waves-effect"><a href="#!">3</a></li>
                                    <li class="waves-effect"><a href="#!">4</a></li>
                                    <li class="waves-effect"><a href="#!">5</a></li>
                                    <li class="waves-effect"><a href="#!"><i
                                                    class="material-icons">chevron_right</i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php require_once "../includes/adminFooter.php" ?>