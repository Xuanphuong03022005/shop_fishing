<div class="image-load" style="display: flex; justify-content: center;">
    <img id="loading-gif" src="public/images/imageGif.gif" style=" width:180px; height:150px ;position: absolute; top: 153px; z-index: 9999">
</div>
<script>
function showgif(){
    const Loadingimage = document.getElementById('loading-gif');
    if(Loadingimage){
        Loadingimage.style.display = 'block';
    }
}
    window.addEventListener('load', function(){
        const Loadingimage = document.getElementById('loading-gif');
        if(Loadingimage){
            Loadingimage.style.display ='none';
        }
    });

</script>