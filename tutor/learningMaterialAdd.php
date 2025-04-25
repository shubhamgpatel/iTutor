<?php require_once "../includes/adminHeader.php" ?>
    <main>
        <div class="container">
            <div class="section">
                <div class="row">
                    <div class="col s12 m12 l8  offset-l2">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Add Job Post</span>
                                <div class="row">
                                    <form class="col s12">
                                        <div class="row margin-bottom-none">
                                            <div class="input-field col s12">
                                                <input id="title" type="text" class="validate">
                                                <label for="password">Title</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <textarea id="textarea2" class="validate materialize-textarea" data-length="120"></textarea>
                                                <label for="password">Description</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <button class="btn waves-effect waves-light" type="submit"
                                                        name="action">Add
                                                </button>
                                                <button class="btn waves-effect waves-light" type="submit"
                                                        name="action">Back to List
                                                </button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
<?php require_once "../includes/adminFooter.php" ?>