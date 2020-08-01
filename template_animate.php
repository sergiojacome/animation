<?php
/**
 * Template Name: Toroid Calculator
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

<?php
while ( have_posts() ) : the_post();
?>
<div id="main-content" class="main-content">
	<div class="wrapper">
	<div class="wrapper_inner">
		<style>
			.page_faq_top { border-bottom:1px solid #ccc; }
			.page_faq_top h2 { color:#005CB9; padding:20px 0; margin:0px; font-size:18px; font-weight:normal; }
			.page_faq_top h2 span{ color:#999; font-size:14px; }
			.page_faq_top h2 a{ color:#005CB9; font-size:14px; }
			.faq_container_header { background:#EBECED; padding:20px; cursor:pointer; }
			.faq_container {  }
			.faq_container .faq_content_container { padding:20px 20px 20px 0px; }
			.faq_container .faq_content_container:nth-child(even){ background: #EBECED; }
			.faq_container .faq_content_container h2{ padding:10px 10px 10px 80px; font-size:14px; font-weight:normal; margin:10px 0;  background:url('<?php echo get_template_directory_uri(); ?>/images/faq_plus.png') no-repeat 25px center; cursor:pointer; }

			.faq_container .faq_content_container:nth-child(even) h2{ background:url('<?php echo get_template_directory_uri(); ?>/images/faq_plus.png') no-repeat 25px center ; }
			.faq_container .faq_content_container .faq_content { padding-top: 20px; margin-top:10px; border-top:1px solid #ccc; display:none; margin-left:80px; }

			.wpapers_anotes_single_container { padding:20px; border-bottom:1px solid #ccc; margin-top:20px; }
			.wpapers_anotes_single_container:first-child { border-top:1px solid #ccc; }
			.wpapers_anotes_logo { display: table-cell; height: 100%; padding-right: 5%; vertical-align: top; width: 35%; }
			.wpapers_anotes_logo img { width:100%; }
			.wpapers_anotes_info { border-left: 1px solid #ccc; display: table-cell; padding-left: 5%; width: 60%; }
			.dates_authors { font-weight:bold; font-size:14px; }
			.wpapers_anotes_date { display:inline-block; margin-right:60px; }
			.wpapers_anotes_author { display:inline-block; }
			.wpapers_anotes_title { color:#005CB9; font-size:16px; padding:10px 0; }
			.wpapers_anotes_content { font-size:12px; }
			.wpapers_anotes_red_more { padding-top:10px; }
			.wpapers_anotes_red_more a { background:#F1F1F1; padding: 10px 20px; font-size:14px; font-weight:bold; color:#000; border-radius:none; display:inline-block; }
			.wpapers_anotes_content p { margin-bottom:10px;display:none; }

			.wpapers_anotes_content p:first-child{display:inline-block;}
			.wpapers_anotes_table_container { display:table; width:100%; }
        </style>
        <div class="page_faq_top">
			<h2>Technical Tools &amp; References</h2>
		</div>
		<div id="app">
        <div class="tabs">
            <div class="tab" :class="(slide.name === selectedTab) ? 'selected' : ''" v-for="slide in slides" @click="selectTab(slide.name)">
                {{slide.name}}
            </div>
        </div>
        <div class="detail-map-container" v-for="slide in slides" v-if="selectedTab === slide.name">
            <section v-for="marker in slide.markers">
                <div class="line" :style="{ marginTop: marker.top, marginLeft: marker.left, height: marker.lineHeight }"
                    v-if="(selectedMarker !== marker.title) ? '' : 'hidden'">
                </div>
                <div class="blue-circle" :style="{ marginTop: marker.top, marginLeft: marker.left }"></div>
                <div class="blue-circle puff-out-center" :style="{ marginTop: marker.top, marginLeft: marker.left }"
                    @click="toggleMarker(marker.title)">
                </div>
            </section>
            <img :src="slide.img" alt="slide.alt" @click="removeSelection()">
        </div>
        <section v-for="slide in slides">
            <section v-for="marker in slide.markers">
                <div class="details" v-if="(selectedMarker !== marker.title) ? '' : 'hidden'">
                    <img :src="marker.img" :alt="marker.title">
                    <div class="box">
                        <div class="">{{marker.title}}</div>
                        <div class=""><a :href="marker.url" class="btn">More</a></div>
                    </div>
                </div>
            </section>
        </section>
    </div>
	</div>
		<div style="clear:both;"></div>
		<style>
        .nopad {
            padding: 0;
            margin: 0;
            font-family: sans-serif;
        }

        .tabs {
            display: flex;
            justify-content: space-evenly;
        }

        .tabs .tab {
            color: #666;
            text-transform: uppercase;
            text-align: center;
            padding: 1rem .25rem;
        }

        .tabs .tab.selected {
            color: rgba(49, 130, 206);
            font-weight: 800;
        }

        .hidden {
            display: none;
        }

        .detail-map-container {
            display: flex;
            position: relative;
        }

        .detail-map-container img {
            max-width: 100vw;
        }

        .line {
            position: absolute;
            left: .45rem;
            bottom: 0;
            border-left: solid 2px #999;
        }

        .line::before {
            display: block;
            position: absolute;
            content: '▲';
            color: #999;
            top: 0;
            transform: translateX(-8.75px) translateY(-7px);
        }

        .details {
            position: absolute;
            background: white;
            width: calc(100% - 2rem);
            border-radius: 10px;
            border: solid 1px #999;
            margin: 0 1rem;
            z-index: 20;
            display: flex;
            flex-direction: column;
        }

        .details img {
            max-width: 99%;
            margin: 1rem auto;
        }

        .details .box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: rgba(237, 242, 247);
            padding: 1rem;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            font-weight: 800;
        }

        .details .box .btn {
            color: #fff;
            background-color: rgba(49, 130, 206);
            padding: .5rem 1.25rem;
            text-decoration: none;
            border-radius: 5px;
        }

        .blue-circle {
            width: 1rem;
            height: 1rem;
            position: absolute;
            display: flex;
            cursor: pointer;
            border-radius: 100%;
            background-color: rgba(49, 130, 206);
        }

        .puff-out-center {
            animation: puff-out-center 1s cubic-bezier(.165, .84, .44, 1.000) infinite both
        }

        @keyframes puff-out-center {
            0% {
                transform: scale(1);
                filter: blur(0);
                opacity: 1
            }

            100% {
                transform: scale(2);
                filter: blur(4px);
                opacity: 0
            }
        }

        @media all and (max-width: 767px) {}
    </style>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js"></script>
    <script>
        var app = new Vue({
            el: '#app',
            data: function () {
                return {
                    selectedTab: 'Automotive',
                    selectedMarker: null,
                    slides: [
                        {
                            name: 'Automotive',
                            img: '<?php echo get_template_directory_uri(); ?>/images/details/car.jpg',
                            alt: 'Automotive',
                            markers: [
                                {
                                    title: 'Surface Mount Beads',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/surface_mount_beads.jpg',
                                    top: '34%',
                                    left: '34%',
                                    lineHeight: '44.75%',
                                    url: 'http://yahoo.com'
                                },
                                {
                                    title: 'Split Supression Cores',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/split_supression_cores.jpg',
                                    top: '40%',
                                    left: '86.6%',
                                    lineHeight: '36%',
                                    url: 'http://bing.com'
                                }, {
                                    title: 'Wound Rods',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/wound_rods.jpg',
                                    top: '35%',
                                    left: '15%',
                                    lineHeight: '43%',
                                    url: 'http://google.com'
                                }, {
                                    title: 'Connector Plates',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/connector_plates.jpg',
                                    top: '39%',
                                    left: '45%',
                                    lineHeight: '37%',
                                    url: 'http://altavista.com'
                                }, {
                                    title: 'Large Planar Cores',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/large_planar_cores.jpg',
                                    top: '58.4%',
                                    left: '74%',
                                    lineHeight: '10%',
                                    url: 'http://aol.com'
                                },
                            ]
                        },
                        {
                            name: 'Medical',
                            img: 'https://www.beltmannlogistics.com/wp-content/uploads/2019/01/medical-equipment-transportation.png',
                            alt: 'Medical',
                            markers: [
                                {
                                    title: 'Surface Mount Beads',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/surface_mount_beads.jpg',
                                    top: '34%',
                                    left: '34%',
                                    lineHeight: '44.75%',
                                    url: 'http://yahoo.com'
                                },
                                {
                                    title: 'Split Supression Cores',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/split_supression_cores.jpg',
                                    top: '40%',
                                    left: '86.6%',
                                    lineHeight: '36%',
                                    url: 'http://bing.com'
                                }, {
                                    title: 'Wound Rods',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/wound_rods.jpg',
                                    top: '35%',
                                    left: '15%',
                                    lineHeight: '43%',
                                    url: 'http://google.com'
                                }, {
                                    title: 'Connector Plates',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/connector_plates.jpg',
                                    top: '39%',
                                    left: '45%',
                                    lineHeight: '37%',
                                    url: 'http://altavista.com'
                                }, {
                                    title: 'Large Planar Cores',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/large_planar_cores.jpg',
                                    top: '58.4%',
                                    left: '74%',
                                    lineHeight: '10%',
                                    url: 'http://aol.com'
                                },
                            ]
                        },
                        {
                            name: 'Other',
                            img: 'https://txtav.com/-/media/textron-aviation/images/news-events/news-releases/2019/2019_09/citation-longitude-image-2_header.ashx?h=580&w=870&la=en&hash=BB9F91386EA2A8DB643F177CD570DA6536FFE363',
                            alt: 'Other',
                            markers: [
                                {
                                    title: 'Surface Mount Beads',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/surface_mount_beads.jpg',
                                    top: '34%',
                                    left: '34%',
                                    lineHeight: '44.75%',
                                    url: 'http://yahoo.com'
                                },
                                {
                                    title: 'Split Supression Cores',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/split_supression_cores.jpg',
                                    top: '40%',
                                    left: '86.6%',
                                    lineHeight: '36%',
                                    url: 'http://bing.com'
                                }, {
                                    title: 'Wound Rods',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/wound_rods.jpg',
                                    top: '35%',
                                    left: '15%',
                                    lineHeight: '43%',
                                    url: 'http://google.com'
                                }, {
                                    title: 'Connector Plates',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/connector_plates.jpg',
                                    top: '39%',
                                    left: '45%',
                                    lineHeight: '37%',
                                    url: 'http://altavista.com'
                                }, {
                                    title: 'Large Planar Cores',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/large_planar_cores.jpg',
                                    top: '58.4%',
                                    left: '74%',
                                    lineHeight: '10%',
                                    url: 'http://aol.com'
                                },
                            ]
                        }
                    ]
                }
            },
            methods: {
                selectTab(title) {
                    this.selectedTab = title
                },
                toggleMarker(title) {
                    this.selectedMarker = title
                },
                removeSelection() {
                    this.selectedMarker = null
                }
            }
        })
    </script>
		</div>  
			<br/>
			<br/>
	</div>
</div>
</div>
 <script>
 function scrolltoelemparent(obj){
	 jQuery('html,body').animate({
		scrollTop:  jQuery(obj).parent().parent().parent().offset().top-210
	 });
 }
 </script>
<?php
endwhile;
get_footer();
