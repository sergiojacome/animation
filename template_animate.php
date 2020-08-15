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
			.faq_container .faq_content_container h2{ padding:10px 10px 10px 80px; font-size:14px; font-weight:normal; margin:10px 0;  background:url('<?php echo get_template_directory_uri(); ?>/<?php echo get_template_directory_uri(); ?>/images/details/faq_plus.png') no-repeat 25px center; cursor:pointer; }

			.faq_container .faq_content_container:nth-child(even) h2{ background:url('<?php echo get_template_directory_uri(); ?>/<?php echo get_template_directory_uri(); ?>/images/details/faq_plus.png') no-repeat 25px center ; }
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
			<h2>Common Uses</h2>
		</div>
		<div id="app">
        <div class="tabs">
            <div class="tab" :class="(slide.name === selectedTab) ? 'selected' : ''" v-for="slide in slides" @click="selectTab(slide.name)">
                {{slide.name}}
            </div>
        </div>
        <div class="detail-map-container" v-for="slide in slides" v-if="selectedTab === slide.name">
            <section v-for="marker in slide.markers">
                <div class="tag" style="transform:translateY(-110%) translateX(-33%)" :style="{ marginTop: marker.top, marginLeft: marker.left }">{{marker.tag}}</div>
                <div class="blue-circle" :style="{ marginTop: marker.top, marginLeft: marker.left }"></div>
                <div class="blue-circle puff-out-center" :style="{ marginTop: marker.top, marginLeft: marker.left }" :content="`
                <div class='img-container'>
                    <img src='${marker.img}' alt='${marker.title}'' class='object-contain'>
                </div>
                <div class='bg-gray-200 flex items-center justify-between description'>
                    <div class='font-bold text-center'>${marker.title}</div>
                    <div>
                        <a href='${marker.url}' class='btn'>More</a>
                    </div>
                </div>
                `" v-tippy="{ allowHTML: true, arrow : true, theme : 'light-border', trigger: 'click', interactive : true, placement : 'bottom' }">
                </div>
                <div :id="marker.id" class="hidden">
                    <img :src="marker.img" :alt="marker.title" class="object-contain">
                    <div class="bg-gray-200 flex items-center justify-between description">
                        <div class="font-bold text-center">{{marker.title}}</div>
                        <div>
                            <a :href="marker.url"
                                class="bg-blue-500 font-semibold text-white px-8 py-2 rounded-lg">More</a>
                        </div>
                    </div>
                </div>
            </section>
            <img :src="slide.img" alt="slide.alt" >
        </div>
    </div>
	</div>
		<div style="clear:both;"></div>
		<style>
        .tabs {
            display: flex;
            justify-content: space-evenly;
        }

        .tabs .tab {
            color: #666;
            text-transform: uppercase;
            text-align: center;
            padding: .5rem .25rem;
            margin: .5rem auto;
            cursor: pointer;
        }

        .tabs .tab.selected {
            color: rgba(49, 130, 206);
            font-weight: 800;
            border-bottom: solid 4px rgba(49, 130, 206);
        }

        .hidden {
            display: none;
        }

        .detail-map-container {
            display: flex;
            position: relative;
            flex-direction: column;
            margin: 5rem auto;
        }

        .detail-map-container img {
            max-width: 100%;
            object-fit: contain;
        }

        .tag {
            position: absolute;
            display: flex;
            border-radius: 5px;
            background-color: rgba(49, 130, 206);
            color: #fff;
            padding: .25rem .5rem;
            font-size:.75rem;
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
        .tippy-tooltip {
            padding: 2px !important;
            background-color: #edf2f7 !important;
        }
        .tippy-arrow {
            transform: scale(1.5);
        }
        .tippy-popper[x-placement^=top] .tippy-arrow {
           border-top-color: #edf2f7 !important;
        }
        .tippy-popper[x-placement^=bottom] .tippy-arrow {
            border-bottom-color: #edf2f7 !important;
        }
        .tippy-tooltip img {
            width: 100%;
            object-fit: cover;
        }
        .img-container {
            background-color: #fff;
            padding: 1rem 0;
        }
        .flex {
            display: flex;
        }
        .items-center {
            align-items: center;
        }
        .justify-between {
            justify-content: space-between;
        }
        .description {
            padding: .75rem .5rem;
            color: #333;
            font-weight: 800;
        }
        .btn {
            color: #fff;
            background-color: rgba(49, 130, 206);
            padding: .5rem 1.25rem;
            text-decoration: none;
            border-radius: 5px;
        }
        @media all and (max-width: 767px) {
            .tippy-popper {
                transform: translateY(550px) translateX(15px) !important;
            }

            .tippy-tooltip {
                max-width: calc(100% - 30px) !important;
            }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js"></script>
    <script src="https://unpkg.com/vue-tippy@4/dist/vue-tippy.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-tippy@4/dist/vue-tippy.min.js"></script>
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
                            img: '<?php echo get_template_directory_uri(); ?>/images/details/car2.jpg',
                            alt: 'Automotive',
                            markers: [
                                {
                                    title: 'Surface Mount Beads',
                                    id: 'surface_mount_beads',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/surface_mount_beads.jpg',
                                    tag: 'Mirror',
                                    top: '17%',
                                    left: '34%',
                                    url: '/'
                                },
                                {
                                    title: 'Split Supression Cores',
                                    id: 'split_supression_cores',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/split_supression_cores.jpg',
                                    tag: 'Charger',
                                    top: '23%',
                                    left: '86.6%',
                                    url: '/'
                                }, {
                                    title: 'Wound Rods',
                                    id: 'wound_rods',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/wound_rods.jpg',
                                    tag: 'Door',
                                    top: '18%',
                                    left: '15%',
                                    url: '/'
                                }, {
                                    title: 'Connector Plates',
                                    id: 'connector_plates',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/connector_plates.jpg',
                                    tag: 'Lights',
                                    top: '22%',
                                    left: '45%',
                                    url: '/'
                                }, {
                                    title: 'Large Planar Cores',
                                    id: 'large_planar_cores',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/large_planar_cores.jpg',
                                    tag:'Cable',
                                    top: '41.4%',
                                    left: '74%',
                                    url: '/'
                                },
                            ]
                        },
                        {
                            name: 'Medical',
                            img: '<?php echo get_template_directory_uri(); ?>/images/details/car2.jpg',
                            alt: 'Medical',
                            markers: [
                                {
                                    title: 'Medical content',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/surface_mount_beads.jpg',
                                    top: '34%',
                                    left: '45%',
                                    url: '/'
                                }
                            ]
                        },
                        {
                            name: 'Agricultural',
                            img: '<?php echo get_template_directory_uri(); ?>/images/details/car2.jpg',
                            alt: 'Agricultural',
                            markers: [
                                {
                                    title: 'Agricultural content',
                                    img: '<?php echo get_template_directory_uri(); ?>/images/details/surface_mount_beads.jpg',
                                    top: '23%',
                                    left: '47%',
                                    url: '/'
                                }
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
