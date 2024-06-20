        <section class="vh-100">
          <div class="container pt-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="col-lg-8">
                <div class="card formlog" style="border-radius: 1rem;">
                  <div class="row">
                    <div class="col-lg-4 d-flex align-items-center justify-content-center">
                      <img src="<?= base_url('assets/img/logoitem.png') ?>" alt="Logo" class="img-fluid" style="max-width: 80%;">
                    </div>
                    <div class="col-lg">
                      <div class="card-body p-4 p-lg-5 text-black">
                        <form method="post" action="<?php echo base_url('Auth'); ?>">
                          <div class="d-flex align-items-center mb-3 pb-1">
                            <img src="" alt="" width="50%">
                          </div>

                          <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your
                            account</h5>
                          <?= $this->session->flashdata('message'); ?>

                          <div class="form-outline mb-4">
                            <label class="form-label" for="">Username</label>
                            <input type="text" id="username" name="username" class="form-control form-control-lg" style="border-radius: 2rem;" value="<?= set_value('username'); ?>" />
                            <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                          </div>

                          <div class=" form-outline mb-4">
                            <label class="form-label" for="form2Example27">Password</label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg" style="border-radius: 2rem;" />
                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                          </div>

                          <div class="form-outline mb-4">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="showPasswordCheckbox" />
                              <label class="form-check-label" for="showPasswordCheckbox"> Show
                                Password
                              </label>
                            </div>
                          </div>

                          <div class="pt-1 mb-4">
                            <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                          </div>

                        </form>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>