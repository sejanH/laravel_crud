
    <!--login-->
<div class="modal fade" id="loginModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="padding:15px 30px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="fa fa-lock"></span> Login</h4>
        </div>
        <div class="modal-body" style="padding:20px 40px;">
          {{ Form::open(array('method' => 'POST','action' => 'Auth\LoginController@login','class' => 'form-horizontal'))}}
            <div class="form-group">
              <label for="usrname"><span class="fa fa-user-circle-o"></span> Username</label>
              <input type="text" class="form-control" name="username" placeholder="Enter username" requi red/>
            </div>
            <div class="form-group">
              <label for="psw"><span class="fa fa-key"></span> Password</label>
              <input type="password" class="form-control" name="password" placeholder="Enter password" requ ired/>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="" checked>Remember me</label>
              <button type="submit" class="btn btn-custom" name="btn-login"><span class="fa fa-unlock"></span> Login</button>
            </div>
          {{ Form::close()}}
        </div>
      </div>
    </div>
  </div>
  <!-- login -->
  <!-- signup -->
  <div class="modal fade" id="signupModal" role="dialog">
  	<div class="modal-dialog">
  		<div class="modal-content">
  			<div class="modal-header" style="padding: 5px 20px;">
  				<button type="button" class="close" data-dismiss="modal">&times;</button>
  				<h4><span class="fa fa-user-plus"></span>  Signup</h4>
  			</div>
  			<div class="modal-body" style="padding:20px 70px;">
  				{{ Form::open(array('method' => 'POST','action' => 'Auth\RegisterController@store','class' => 'form-horizontal'))}}
  					<div class="form-group">
  						<label><span class="fa fa-user"></span> Username</label>
  						<input class="form-control" type="text" name="username" placeholder="User Name"/>
  					</div>
            <div class="form-group">
              <label><span class="fa fa-clock-o"></span> Your TimeZone</label>
              <select required="true" name="timezone" class="form-control">
                <?php $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
                foreach ($tzlist as $tz) { ?>
                  <option>{!!$tz!!}</option>
                <?php } ?>
                </select>
              </div>
  					<div class="form-group">
  						<label><span class="fa fa-key"></span> Password</label>
  						<input class="form-control" type="password" name="password" placeholder="Your Password"/>
  					</div>
  					<div class="form-group">
  						<label><span class="fa fa-envelope"></span> Email</label>
  						<input class="form-control" type="email" name="email" placeholder="Your Email"/>
  					</div>
  					<div class="form-group">
  						<label><span class="fa fa-comment"></span>  Security Question Answer</label>
  						<input class="form-control" type="text" name="securityQA" placeholder="What is your favorite color?"/>
  					</div>
  					<button class="btn btn-custom" type="submit" name="btn-signup">Sign Me Up</button>
  				{{Form::close()}}
  			</div>
  		</div>
  	</div>
  </div>
  <!-- signup -->