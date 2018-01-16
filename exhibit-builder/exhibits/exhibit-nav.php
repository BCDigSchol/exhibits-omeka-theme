<div class="exhibit-nav-container">
    <p>
        <button class="btn btn-primary jump-button collapsed" type="button" data-toggle="collapse" data-target="#exhibit-nav-box" aria-expanded="false" aria-controls="exihibit-nav-box">
            Jump to…
        </button>
        <span class="x-button" onclick="$('#exhibit-nav-box').collapse('hide'); console.log('called');">x</span>
    </p>
    <div class="collapse" id="exhibit-nav-box">
        <div class="card card-body">
            <?= custom_exhibit_builder_page_nav() ?>
        </div>
    </div>
</div>