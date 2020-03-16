<?php include __DIR__ . '/layout/header.php'; ?>
<div class="container page">
    <h1><?= $data['title']; ?></h1>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Cpf/Cnpj</th>
                <th>Email</th>
                <th>Data</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['customers'] as $customer): ?>
            <tr>
                <td><?= $customer->id; ?></td>
                <td><?= $customer->name; ?></td>
                <td><?= $customer->cpf_cnpj; ?></td>
                <td><?= $customer->email; ?></td>
                <td><?= $customer->created_at; ?></td>
                <td>
                    <a href="/customers/<?= $customer->id; ?>" class="btn btn-sm btn-primary">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="/customers/<?= $customer->id; ?>" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include __DIR__ . '/layout/footer.php'; ?>
