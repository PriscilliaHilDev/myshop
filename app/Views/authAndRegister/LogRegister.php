<div role="main" class="main shop py-4">

				<div class="container py-4">

					<div class="row justify-content-center">
						<div class="col-md-6 col-lg-5 mb-5 mb-lg-0">
							<h2 class="font-weight-bold text-5 mb-0">Login</h2>
							<form action="<?php echo base_url('auth/connexion')?>" id="frmSignIn" method="post" class="needs-validation">
								<div class="form-row">
									<div class="form-group col">
										<label class="text-color-dark text-3">Email address <span class="text-color-danger">*</span></label>
										<input type="text" value="<?php echo $request->getVar('emailLogin');?>" name="emailLogin" class="form-control form-control-lg text-4">
										<?php if(isset($validation) && $validation->hasError('emailLogin'))
											{
												echo '<h5> <span class="text-danger">'.$validation->getError('emailLogin').'</span></h5>';
											} 
										?>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col">
										<label class="text-color-dark text-3">Password <span class="text-color-danger">*</span></label>
										<input type="password" value="" name="passwordLogin" class="form-control form-control-lg text-4">
										<?php if(isset($validation) && $validation->hasError('passwordLogin'))
											{
												echo '<h5> <span class="text-danger">'.$validation->getError('passwordLogin').'</span></h5>';
											} 
											if($passError){
												echo '<h5> <span class="text-danger">Mot de passe incorrecte </span></h5>';
											}
										?>
									</div>
									
								</div>
								<a  href="#lien-non-fonctionnel"> Mot de passe oublié ? </a>
								<div class="form-row">
									<div class="form-group col">
										<button type="submit" class="btn btn-dark btn-modern btn-block text-uppercase rounded-0 font-weight-bold text-3 py-3" data-loading-text="Loading...">Login</button>
								
									</div>
								</div>
							</form>
						</div>
						<div class="col-md-6 col-lg-5">
							<h2 class="font-weight-bold text-5 mb-0">Register</h2>
							<form action="<?php echo base_url("auth/inscris")?>" id="frmSignUp" method="post">
								<div class="form-row">
									<div class="form-group col">
										<label class="text-color-dark text-3">Username or email address <span class="text-color-danger">*</span></label>
										<input type="text" value="<?php echo $request->getVar('email');?>"  name="email" class="form-control form-control-lg text-4" >
										<?php if(isset($validation) && $validation->hasError('email'))
												{
													echo '<h5> <span class="text-danger">'.$validation->getError('email').'</span></h5>';
												} 
										?>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col">
										<label class="text-color-dark text-3">Password <span class="text-color-danger">*</span></label>
										<input type="password" value="" name="password" class="form-control form-control-lg text-4">
										<?php if(isset($validation) && $validation->hasError('password'))
											{
												echo '<h5> <span class="text-danger">'.$validation->getError('password').'</span></h5>';
											} 
										?>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col">
										<label class="text-color-dark text-3">Confirm password <span class="text-color-danger">*</span></label>
										<input type="password" value="" name="confpassword" class="form-control form-control-lg text-4" >
										<?php if(isset($validation) && $validation->hasError('confpassword'))
											{
												echo '<h5> <span class="text-danger">'.$validation->getError('confpassword').'</span></h5>';
											} 
										?>
									</div>
								</div>
								
								<div class="form-row">
									<div class="form-group col">
										<p class="text-2 mb-2">Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our <a href="#" class="text-decoration-none">privacy policy.</a></p>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col">
										<button type="submit" class="btn btn-dark btn-modern btn-block text-uppercase rounded-0 font-weight-bold text-3 py-3" data-loading-text="Loading...">Register</button>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>

			</div>