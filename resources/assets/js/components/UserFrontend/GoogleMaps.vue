<template>
    <el-row v-loading="loading">
        <div id="map"></div>
    </el-row>
</template>

<script>
    export default {
            props: ['cords', 'zoomlevel'],
            data() {
              return {
                  lat: 0,
                  lng: 0,
                  loading: false
              }
            },
            watch: {
              cords() {
                  this.lat = this.cords[0];
                  this.lng = this.cords[1];
                  this.createMap();
              }
            },
            methods: {
                createMap() {
                    let map = new google.maps.Map(document.getElementById('map'), {
                        center:{lat: this.lat, lng: this.lng },
                        zoom: this.zoomlevel,
                        streetViewControl: false,
                        rotateControl: false,
                        mapTypeControl: false,
                        scrollwheel: true,
                    });

                    new google.maps.Marker({
                        map: map,
                        position:{lat: this.lat, lng: this.lng},
                    });
                }
            }
        }
</script>

<style>
    #map {
        height: 250px;
    }

</style>
