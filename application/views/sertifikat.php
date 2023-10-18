<div class="card card-body card_ilmi" style="padding-left: 28px;padding-right:0px;margin-left:20px;margin-right:20px">
    <div style="display:flex;margin-bottom:20px;">
        
        <li class="d-flex " style="padding-left: 0px;width: 155px;">
            <button id="btn-bnsp" class="btn btn-outline-primary btn-sm mb-0 me-3 btn-filter" filter-sertif="all" style="padding-left: 0px;padding-top:0px;padding-bottom:0px;">
                <div style="background-color: #F1F0FD;display:inline-block;margin-right:16px ;padding-left:8px;padding-right: 9px;padding-bottom:8px;padding-top:8px;border-radius:6px;">
                    <img src="<?php echo base_url() ?>assets/assets/img/sertifikat/icon.svg" style="">
                </div>
                All
            </button>
        </li>
        <li class="d-flex " style="padding-left: 0px;width: 155px;">
            <button id="btn-bnsp" class="btn btn-outline-primary btn-sm mb-0 me-3 btn-filter" filter-sertif="bnsp" style="padding-left: 0px;padding-top:0px;padding-bottom:0px;">
                <div style="background-color: #F1F0FD;display:inline-block;margin-right:16px ;padding-left:8px;padding-right: 9px;padding-bottom:8px;padding-top:8px;border-radius:6px;">
                    <img src="<?php echo base_url() ?>assets/assets/img/sertifikat/image.svg" style="">
                </div>
                BNSP
            </button>
        </li>
        <li class="d-flex " style="padding-left: 0px;">
            <button class="btn btn-outline-primary btn-sm mb-0  me-3 btn-filter" filter-sertif="amd" style="padding-left: 0px;padding-top:0px;padding-bottom:0px;">
                <div style="background-color: #FFF5EC;display:inline-block;margin-right:16px ;padding-left:8px;padding-right: 9px;padding-bottom:8px;padding-top:8px;border-radius:6px;">
                    <img src="<?php echo base_url() ?>assets/assets/img/sertifikat/paper.svg" style="">
                </div>
                AMD Academy
            </button>
        </li>
    </div>

    <div style="display: flex;gap: 20px;flex-wrap: wrap;">

        <?php foreach ($data_sertif->result() as $key => $l) :
            $rows = json_decode($l->link);
            if($rows->bnsp == ""){
                continue;
            }
        ?>
        <div id="jenis-sertif" class="jenis-sertif bnsp">
        <a  href="<?php echo implode($link = array('bnsp' => $rows->bnsp))?>" target="_blank" style="width:244px;height:188px;background-color: white;box-shadow: 0 0 0 2px #F8F8F8;" >    
                <?php 
                    $arr = implode(array('bnsp' => $rows->bnsp));
                    $arr = explode('/', $arr);
                    $link_bnsp = array_slice($arr, 0, 6);
                ?>
                <iframe src="<?php echo implode('/', $link_bnsp)?>/preview" style="height: 220px; width: 300px"></iframe>
            <h6 style="padding-left:5px;padding-top:5px;"><?= $l->nama_pelatihan?></h6>
            <p style="padding-left:5px;padding-top:5px;margin-top:-10px;font-size: 13px;">BNSP</p>
        </a>
        </div>
        <?php endforeach ?>
       
        <?php foreach ($data_sertif->result() as $key => $l) : 
            $rows = json_decode($l->link);
            if($rows->amd == ""){
                continue;
            }
        ?>
        <div id="jenis-sertif" class="jenis-sertif amd">
        <a href="<?php echo implode($link = array('amd' => $rows->amd))?>" target="_blank" style="width:244px;height:188px;background-color: white;box-shadow: 0 0 0 2px #F8F8F8;" >
            <?php 
                $arr = implode(array('bnsp' => $rows->amd));
                $arr = explode('/', $arr);
                $link_amd = array_slice($arr, 0, 6);
            ?>
            <iframe src="<?php echo implode('/', $link_amd)?>/preview" style="height: 220px; width: 300px"></iframe>
            <h6 style="padding-left:5px;padding-top:5px;"><?= $l->nama_pelatihan?></h6>
            <p style="padding-left:5px;padding-top:5px;margin-top:-10px;font-size: 13px;">AMD Academy</p>
        </a>
        </div>
        <?php endforeach ?>
    </div>

</div>
<script type='text/javascript'>
    $(document).ready(function(){
        $('.btn-filter').click(function(){
            const value = $(this).attr('filter-sertif');
            if (value == 'all'){
                $('.jenis-sertif').show('1000');
            }else{
                $('.jenis-sertif').not('.'+value).hide('1000');
                $('.jenis-sertif').filter('.'+value).show('1000');
            }
        });
    })
    
</script>