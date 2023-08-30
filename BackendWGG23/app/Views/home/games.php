<?= $this->extend('layouts/main_layouts') ?>

<?= $this->section('css') ?>

<?= $this->endsection() ?>

<?= $this->section('content') ?>
<!-- <div class="text-center alert alert-warning px-2 mx-2 mt-4">Info mengenai website Games akan dibertahukan lebih lanjut</div> -->
<div class="container">
<div class="row mt-4">
    <div class="col-1"></div>
    <div class="col-10">
        <ul>
            <li>
                <p>
                    Bagaimana cara akses website games?<br><br>
                    <b>Akses website dapat melalui link <span class="text-blue">wgg.petra.ac.id/wgg23/games</span>.</b>
                </p>
            </li>
            <li>
                <p>
                    Apakah website games dapat diakses melalui smartphone?<br><br>
                    <b>Akses website games hanya dapat melalui laptop.</b>
                </p>
            </li>
            <li>
                <p>
                    Apa yang harus dilakukan di website?<br><br>
                    <b>Mahasiswa baru dapat membaca faq yang berada di website games.</b>
                </p>
            </li>
        </ul>
    </div>
</div>
</div>
<?= $this->endsection() ?>