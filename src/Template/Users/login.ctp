
<div class="login">
    <!-- <h1 id="LoginForm">Login</h1> -->
    <?= $this->Form->create() ?>
    <div class="LoginID">
    <?= $this->Form->input('user') ?>
    </div>
    <div>
    <?= $this->Form->input('password') ?>
    </div>
    <div class="LoginFormButton">
        <div class="loginButton">
        <?= $this->Form->button('Login') ?>
        </div>
        <div class="returnButton">
        <?= $this->Form->button('Return') ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>
