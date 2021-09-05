<template>
    <div>
        <!-- Header -->
        <div class="header" :style="'background-image: url('+route('front.index')+'/assets/images/inner_banner.jpg)'">
            <nav class="uk-navbar-container" uk-navbar>
                <div class="uk-navbar-left mx-4">
                    <a href="#">
                        <img
                            :src="route('front.index')+'/assets/images/gujarat_police_logo.png'"
                            alt="Logo"
                            style="width: 20vw; max-width: 100px"
                        />
                    </a>
                </div>
                <div
                    class="uk-navbar-right container-fluid d-none d-lg-flex"
                    style="max-width: 90%"
                >
                    <a href="#">About Us</a>
                    <a href="#">Cyber Crime</a>
                    <a href="#">Initiative</a>
                    <a href="#">Messages</a>
                    <a href="#">Guidelines</a>
                    <a href="#">Search Fraud Mobile No</a>
                    <a href="#">Search Fraud Bank A/C no</a>
                    <a href="#" id="blink">Fact Check</a>
                    <a href="#">Contact</a>
                    <a href="#">
                        <select
                            class="bg-transparent border-0 p-0 m-0"
                            style="color: white; font-weight: 600; cursor: pointer"
                        >
                            <option selected>ENG</option>
                            <option>GUJ</option>
                        </select>
                    </a>
                    <a href="#">A-</a>
                    <a href="#">A</a>
                    <a href="#">A+</a>
                </div>

                <!-- mobnav -->
                <a href="#offcanvas-usage" class="d-flex d-lg-none" uk-toggle
                ><img
                    src="https://img.icons8.com/material-outlined/24/ffffff/menu--v1.png"
                    style=" width: 2rem;  height: 2rem; display: flex; position: absolute; top: 2rem; right: 2rem; " /></a>

                <div id="offcanvas-usage" uk-offcanvas="mode: reveal">
                    <div
                        class="uk-offcanvas-bar"
                        style="background-color: rgb(0, 0, 0); color: black"
                    >
                        <button
                            class="uk-offcanvas-close"
                            type="button"
                            uk-close
                            style="color: rgb(255, 255, 255); padding-top: 1rem"
                        ></button>

                        <div class="links" style="display: flex; flex-direction: column">
                            <a href="#">About Us</a>
                            <a href="#">Cyber Crime</a>
                            <a href="#">Initiative</a>
                            <a href="#">Messages</a>
                            <a href="#">Guidelines</a>
                            <a href="#">Search Fraud Mobile No</a>
                            <a href="#">Search Fraud Bank A/C no</a>
                            <a href="#" id="blink">Fact Check</a>
                            <a href="#">Contact</a>
                            <a href="#">
                                <select
                                    class="bg-transparent border-0 p-0 m-0"
                                    style="color: white; font-weight: 600; cursor: pointer"
                                >
                                    <option selected>ENG</option>
                                    <option>GUJ</option>
                                </select>
                            </a>
                            <a href="#">A-</a>
                            <a href="#">A</a>
                            <a href="#">A+</a>
                        </div>
                    </div>
                </div>
                <!-- mobnav -->
            </nav>
            <div class="caption text-center">
                <h1>Are You a Good Citizen ?</h1>
            </div>
        </div>
        <!-- Header -->

        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8" v-if="$page.props.flash.success || $page.props.flash.error">
            <action-message :on="$page.props.flash.success">
                <div class="bg-green-300 text-green-800 w-full p-3 shadow flex justify-between">
                    {{ $page.props.flash.success}}
                    <button type="button" class="close" aria-label="Close" @click.prevent="closeAlertMsg">
                        <span aria-hidden="true" class="text-white font-weight-bold">&times;</span>
                    </button>
                </div>
            </action-message>

            <action-message :on="$page.props.flash.error">
                <div class="bg-red-300 text-red-800 w-full p-3 shadow flex justify-between">
                    {{ $page.props.flash.error}}
                    <button type="button" class="close" aria-label="Close" @click.prevent="closeAlertMsg">
                        <span aria-hidden="true" class="text-white font-weight-bold">&times;</span>
                    </button>
                </div>
            </action-message>
        </div>
        <slot></slot>
    </div>
</template>

<script>
import ActionMessage from "@/Jetstream/ActionMessage";
export default {
    name: "FrontendLayout",
    components: {
        ActionMessage
    }
}
</script>

<style scoped>

</style>
