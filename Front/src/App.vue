<template>
    <ion-app>
        <ion-header>
            <ion-toolbar>
                <ion-buttons slot="start">
                    <ion-menu-button></ion-menu-button>
                </ion-buttons>
                <ion-title>Maracana</ion-title>
            </ion-toolbar>
        </ion-header>

        <ion-menu content-id="main-content">
            <ion-header>
                <ion-toolbar>
                    <ion-title>Menu</ion-title>
                </ion-toolbar>
            </ion-header>
            <ion-content :scroll-y="false">
                <ion-list>
                    <ion-list-header>Menu</ion-list-header>
                    <ion-item router-link="/" @click="closeMenu"
                        >Accueil</ion-item
                    >
                    <ion-item
                        v-if="isConnected"
                        router-link="/subscription"
                        @click="closeMenu"
                        >Nos offres</ion-item
                    >
                    <ion-item router-link="/news" @click="closeMenu"
                        >Actualités</ion-item
                    >
                    <ion-item router-link="/contact" @click="closeMenu"
                        >Contact</ion-item
                    >

                    <ion-list-header>Mon compte</ion-list-header>
                    <ion-item
                        v-if="!isConnected"
                        router-link="/signup"
                        @click="closeMenu"
                        >Inscription</ion-item
                    >
                    <ion-item
                        v-if="!isConnected"
                        router-link="/login"
                        @click="closeMenu"
                        >Connexion</ion-item
                    >
                    <ion-item
                        v-if="isConnected"
                        router-link="/account"
                        @click="closeMenu"
                        >Mon compte</ion-item
                    >

                    <ion-list-header>A propos</ion-list-header>
                    <ion-item router-link="/legal" @click="closeMenu"
                        >Mentions légales</ion-item
                    >
                    <ion-item router-link="/terms" @click="closeMenu"
                        >CGU/CGV</ion-item
                    >
                    <ion-item router-link="/privacypolicy" @click="closeMenu"
                        >Politique de confidentialité</ion-item
                    >
                </ion-list>
            </ion-content>
        </ion-menu>

        <ion-router-outlet id="main-content"></ion-router-outlet>
    </ion-app>
</template>

<script>
import {
    IonApp,
    IonHeader,
    IonToolbar,
    IonButtons,
    IonMenuButton,
    IonTitle,
    IonMenu,
    IonContent,
    IonList,
    IonListHeader,
    IonItem,
    IonRouterOutlet,
    menuController,
} from "@ionic/vue";
import { ref, watch } from "vue";
import { useAuthStore } from "@/stores/auth";

export default {
    components: {
        IonApp,
        IonHeader,
        IonToolbar,
        IonButtons,
        IonMenuButton,
        IonTitle,
        IonMenu,
        IonContent,
        IonList,
        IonListHeader,
        IonItem,
        IonRouterOutlet,
    },
    setup() {
        const authStore = useAuthStore();
        const isConnected = ref(authStore.isConnected);

        watch(
            () => authStore.isConnected,
            (newValue) => {
                isConnected.value = newValue;
            }
        );

        const closeMenu = () => {
            menuController.close();
        };

        return {
            isConnected,
            closeMenu,
        };
    },
};
</script>

<style scoped>
.hero h1 {
    font-size: 2.5em;
    margin-bottom: 20px;
}

.hero p {
    font-size: 1.2em;
    margin-bottom: 40px;
}

ion-list-header {
    font-weight: bold;
    font-size: 1.1em;
    margin-top: 20px;
}

ion-item {
    --border-style: none;
    --border-width: 0;
    font-size: 1em;
}

ion-menu {
    --background: #ffffff;
}

ion-header {
    --background: #15854b;
    --color: white;
}
</style>
