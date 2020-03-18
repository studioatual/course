<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="container page">
    <br />
    <div class="row">
        <div class="col-md-10">
            <h1><?= $data['title']; ?></h1>
        </div>
        <div class="col-md-2" style="align-self: center;"><a href="/customers" class="btn btn-sm btn-block btn-info" style="vertical-align: middle;">Go Back</a></div>
    </div>
    <form action="/customers" method="POST" autocomplete="off" class="form">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nome / Razão Social</label>
                    <input type="text" name="name" value="<?= (isset($data['name'])) ? $data['name'] : ''; ?>" class="form-control" required />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="cpf_cnpj">CPF / CNPJ</label>
                    <input type="text" name="cpf_cnpj" value="<?= (isset($data['cpf_cnpj'])) ? $data['cpf_cnpj'] : ''; ?>" class="form-control" required />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="rg_ie">RG / I.E.</label>
                    <input type="text" name="rg_ie" value="<?= (isset($data['rg_ie'])) ? $data['rg_ie'] : ''; ?>" class="form-control" required />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" value="<?= (isset($data['email'])) ? $data['email'] : ''; ?>" class="form-control" required />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" value="<?= (isset($data['password'])) ? $data['password'] : ''; ?>" class="form-control" <?= (isset($data['id'])) ? 'required' : ''; ?> />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="password_confirm">Password Confirm</label>
                    <input type="password" name="password_confirm" value="<?= (isset($data['password_confirm'])) ? $data['password_confirm'] : ''; ?>" <?= (isset($data['id'])) ? 'required' : ''; ?> class="form-control" />
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-lg btn-success">Salvar</button>
    </form>
</div>
<?php include __DIR__ . '/../layout/footer.php'; ?>
