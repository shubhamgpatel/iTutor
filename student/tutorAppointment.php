<?php require_once "../includes/adminHeader.php" ?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.datepicker');
    var instances = M.Datepicker.init(elems, options);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('.datepicker').datepicker();
  });
     
</script>
    <main>
        <div class="container">
            <div class="section">
                <div class="row">
                    <div class="col s12 m12 l8  offset-l2">
                        <div class="card">
                            <div class="card-content">
                            <span class="card-title">Tutor appointment</span>
                            <div class="row">
                                    <form class="col s12">
									
									<div class="input-field col s12 m12 l12">
										<select class="browser-default">
										<!--<i class="material-icons prefix">person</i>-->
											<option value="" disabled selected>Select Tutor</option>
											<option value="1">Chirstine</option>
											<option value="2">Priyanka</option>
											<option value="3">Bernie</option>
										</select>
									</div>
									  
                                       <!-- <div class="row margin-bottom-none">-->
										<div class="input-field col s12 m12 l12">
											<select class="browser-default">
											<!--<i class="material-icons prefix">person</i>-->
												<option value="" disabled selected>Select Subject</option>
												<option value="1">Digital Design</option>
												<option value="2">Accounting</option>
												<option value="3">Web Info Architecture</option>
												<option value="4">Food Management</option>
											</select>
										</div>
										
										<div class="input-field col s12 m12 l12">
											<select class="browser-default">
											<!--<i class="material-icons prefix">person</i>-->
												<option value="" disabled selected>Select Room</option>
												<option value="1">R01</option>
												<option value="2">R02</option>
												<option value="3">R04</option>
											</select>
										</div>
                                        
                                      
                                       <div class="row">
									  <div class="input-field col s12">
										<textarea id="message" class="materialize-textarea" data-length="120"></textarea>
										<label for="message">Message</label>
									  </div>
									</div>
                                             <div class="input-field col s12">
											<i class="material-icons prefix">date_range</i>
											<input id="selectDate" type="text" class="validate datepicker">
											<label for="selectDate">Select Date</label>
										  </div>
										  <!--<input type="text" class="timepicker">-->
                                           
                                            <div class="input-field col s12">
                                                <button class="btn waves-effect waves-light" type="submit"
                                                        name="action">Make Appointment
                                                </button>
                                                <button class="btn waves-effect waves-light" type="submit"
                                                        name="action">Clear
                                                </button>
                                            </div>
                                    </form>
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
<?php require_once "../includes/adminFooter.php" ?>