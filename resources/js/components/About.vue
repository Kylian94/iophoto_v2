<template>
    <div class="marginNav">
        <v-layout class="med-screen">
            <v-flex md4 xs6 align-center justify-center ml-5 pl-5 my-auto>
                <h1 class="display-4 font-weight-black dark--text hidden-sm-and-down ">A PROPOS DE NOUS</h1> 
                <h1 class="display-1 font-weight-black dark--text hidden-sm-and-up ">A PROPOS DE NOUS</h1> 
            </v-flex>
        </v-layout>
        <v-layout justify-center class="mt-4">
            <v-flex md8 xs12>
                <v-layout justify-center>
                    <v-flex md4 class="hidden-sm-and-down pa-4">
                        <h3 class="mb-4">IO.PHOTO AWARDS & ACCOLADES</h3>
                        <h4>2018</h4>
                        <ul class="mb-4">
                            <li class="mb-3">
                                <b>Universum</b><br>
                                Ranked #5<br>
                                <i>Top 10 Most Attractive Employers in the US</i>
                            </li>
                            <li class="mb-3">
                                <b>Career Bliss</b><br>
                                Ranked #2<br>
                                <i>Happiest Companies to Work for in 2018</i>
                            </li>
                            <li class="mb-3">
                                <b>Glassdoor</b><br>
                                <i>Employees’ Choice Award 2018 Best Places to Work</i>
                            </li>	
                            <li class="mb-3">
                                <b>Human Rights Campaign</b><br>
                                <i>Best Place to Work for LBGTQ Equality</i>
                                <span>16 years in a row</span>
                            </li>		
                            <li class="mb-3">
                                <b>Vault.com</b><br>
                                Ranked #11<br>
                                <i>Most Prestigious Internships for 2018</i>
                            </li>
                        </ul>
                        <h4>2017</h4>
                        <ul>
                            <li class="mb-3">
                                <b>Universum</b><br>
                                Ranked #5<br>
                                <i>Top 10 Most Attractive Employers in the US</i>
                            </li>
                            <li class="mb-3">
                                <b>Career Bliss</b><br>
                                Ranked #2<br>
                                <i>Happiest Companies to Work for in 2018</i>
                            </li>
                            <li class="mb-3">
                                <b>Glassdoor</b><br>
                                <i>Employees’ Choice Award 2018 Best Places to Work</i>
                            </li>	
                            <li class="mb-3">
                                <b>Human Rights Campaign</b><br>
                                <i>Best Place to Work for LBGTQ Equality</i>
                                <span>16 years in a row</span>
                            </li>		
                            <li class="mb-3">
                                <b>Vault.com</b><br>
                                Ranked #11<br>
                                <i>Most Prestigious Internships for 2018</i>
                            </li>
                        </ul>
                    </v-flex>
                    <v-flex md8 class="pa-4 ml-md-4">
                        <v-layout flex-column>
                            <v-flex md12 xs12 mb-4>
                                <img class="logo ml-4" src="/img/logo_dark.png" alt="">
                            </v-flex>
                            <v-flex md12 xs12 mt-4 >
                                <h2 class="display-1 font-weight-regular dark--text">OUR MISSION</h2>
                                <h1 class="display-3 font-weight-black dark--text wrap-text">BRING INSPIRATION AND INNOVATION TO EVERY PHOTOGRAPHER* IN THE WORLD.</h1>
                                <p class="mt-4">
                                    Because we exist to serve photographers, we dare to design the future of sport. <br><br>

                                    To us, innovation is about elevating human potential. We obsess the needs of the world’s best photographers, using their insights to create products that are beautiful and useful for everyone. <br><br>

                                    To make big leaps, we take big risks. Incremental change won’t get us to where we want to go fast enough. So we pursue moonshots — like developing the first self-lacing shoe, running the first two-hour marathon, and committing to 100% renewable energy use in our facilities. <br><br>

                                    At IO.Photo, every employee is an explorer. We unite diverse perspectives — scientists and shoe designers, coders and quarterbacks — to share knowledge of the body in motion. We house countless designers and innovators. That includes computer scientists, biomechanists, physiologists, chemists, materials developers — even a planetary astrophysicist. <br><br>

                                    At IO.Photo, it’s in our nature to innovate. <br><br>
                                </p>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
    </div>
</template>
<script>
export default {
    
}
</script>
<style lang="css">
    .med-screen {
        height:60vh;
        background: url('/img/about_banner.jpg');
        background-size : 100% 100%;
    }
    @media screen and (max-width: 380px) {
        .med-screen {
        height:50vh;
        background: url('/img/about_banner_mobile.jpg');
        }
    }
    .logo {
        transform: scale(2);
    }
    .wrap-text {
        overflow-wrap: break-word;
    }
    
</style>