<div class="sidebar" data-color="orange" data-image="{{ asset('img/1.jpg') }}">
    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
            Ct
        </a>

		<a href="http://www.creative-tim.com" class="simple-text logo-normal">
			Creative Tim
		</a>
    </div>

	<div class="sidebar-wrapper">
        <div class="user">
			<div class="info">
				<div class="photo">
                    <img src="{{ asset('img/1.jpg') }}" />
                </div>

				<a data-toggle="collapse" href="#collapseExample" class="collapsed">
					<span>
						Tania Andrew
                        <b class="caret"></b>
					</span>
                </a>

				<div class="collapse" id="collapseExample">
					<ul class="nav">
						<li>
							<a href="#pablo">
								<span class="sidebar-mini">MP</span>
								<span class="sidebar-normal">My Profile</span>
							</a>
						</li>

						<li>
							<a href="#pablo">
								<span class="sidebar-mini">EP</span>
								<span class="sidebar-normal">Edit Profile</span>
							</a>
						</li>

						<li>
							<a href="#pablo">
								<span class="sidebar-mini">S</span>
								<span class="sidebar-normal">Settings</span>
							</a>
						</li>
					</ul>
                </div>
			</div>
        </div>

		<ul class="nav">
			<li>
				<a href="{{ route('phong.view_all') }}">
					<i class="pe-7s-graph"></i>
					<p>Sinh Vien</p>
				</a>
			</li>
		</ul>
	</div>
</div>
