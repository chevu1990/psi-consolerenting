        <div id ="login" class="col-md-8">

            <table style="float:right;">
                <?php
                echo form_open('user/login_validation');
                echo validation_errors();
                ?>
                <tr>
                    <td> &nbsp;<td>
                </tr>
                 <tr>
                    <td> &nbsp;<td>
                </tr>                  
                <tr>
                    <td></td><td>Email:</td><td>Password:</td>
                </tr>
                <tr>
                    <td><p style="color: red; font-size: 110%;">Please Log in</p></td>
                    <td><?php echo form_input('email', $this->input->post('email'), "class = 'form-control'"); ?></td>
                    <td><?php echo form_password('password', '', "class = 'form-control'"); ?></td>
                    <td><?php echo form_submit('login_submit', 'Log In',  "class='btn btn-primary'"); ?></td>
                </tr>
            </table>
        </div>

    </div
</div>
