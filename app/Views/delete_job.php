<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('conteudo') ?>

<header class="container">
    <div class="row">
        <div class="col align-self-center">
            <h3 class="p-3">ToDo List</h3>
        </div>
        <div class="col text-right align-self-center">
            <h3>Eliminar tarefa</h3>
        </div>
    </div>
</header>

<hr>

<div class="container">
    <div class="row">
        <div class="col text-center">
            <h4>Tem a certeza que pretende eliminar a tarefa:</h4>
            <div class="card p-2 my-4 bg-light">
                <h5><?= $job->job ?></h5>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <a href="<?= site_url('main') ?>" class="btn btn-secondary">Não</a>
            <a href="<?= site_url('main/deletejobconfirm/'.$job->id_job) ?>" class="btn btn-primary">Sim</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>