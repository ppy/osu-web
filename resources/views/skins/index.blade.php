@extends("master")

@section("content")
<div class="row-page">
    <div class="text">
    <p>//TODO: background image as featured skin</p>
    </div>
</div>
<div class="row-subpage">
	<div class="profile-tabs"> 
		<a href="#" class="profile-tab profile-tab--active"> Fresh </a>
		<a href="#" class="profile-tab"> Popular </a>
		<a href="#" class="profile-tab"> Staff Picks </a>
		<a href="#" class="profile-tab"> Completed </a>
		<a href="#" class="profile-tab"> WIPs </a>
		<a href="#" class="profile-tab skinsort-tab--special"> Upload Skin </a>
	</div>
	<br/>
	<div class="input-search-container"> 
		<input placeholder="type in keywords" />
		<div class="fa fa-search"></div>
	</div>
	<br/>
	<div class="skinmode-tabs">
		<div class="skinmode-tab skinmode-tab--active">all</div>
		<div class="skinmode-tab">osu!</div>
		<div class="skinmode-tab">osu!ctb</div>
		<div class="skinmode-tab">osu!taiko</div>
		<div class="skinmode-tab">osu!mania</div>
	</div>
	<br/>
	<div class="row-page row-blank skins-listing">
		<div class="col-sm-6 skins-listing-skin" >
			<div class="skin-box-background" style="background-image: url('http://fotonin.com/data_images/out/1/736468-anime-wallpapers.jpg'); background-size:430px; height:200px;">
				<div class="skin-box-content"> 
					<div class="skin-box-content--details">
					 <div>
					 	<div class="fa fa-cloud-download"></div> 4,569,212
					 </div>
					 <div>
					 	<div class="fa fa-heart"></div> 2.229
					 </div>
					</div>
					<div class="skin-box-content--names">
						<span>Pastel</span> <small> v13.37c final</small>
					</div>
					<div class="skin-box-content--author">
						by <b>flyte</b>
					</div>
					<div class="skin-box-content--gamemodes">
						<div class="osu fa-osu-o"></div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
@stop