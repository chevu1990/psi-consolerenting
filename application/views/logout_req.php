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
                    <td><p style="color: red; font-size: 110%;">You must logout to be able to register.</p></td>
                </tr>
            </table>
        </div>

    </div
</div>
