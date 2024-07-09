<template>
    <ion-page>
        <ion-header>
            <ion-toolbar>
                <ion-title>Accueil</ion-title>
            </ion-toolbar>
        </ion-header>

        <ion-content class="ion-padding">
            <!-- Section Héros -->
            <ion-grid class="hero">
                <ion-row class="ion-justify-content-center">
                    <ion-col size="12" size-md="8" class="hero-content">
                        <ion-img src="/img/home.jpg" alt="Image de sport"></ion-img>
                        <ion-text color="light">
                            <h1>Réservez vos terrains de sport en toute simplicité ⚽️🏀</h1>
                        </ion-text>
                        <ion-text color="light">
                            <p>Accédez à un large choix de terrains et organisez vos matchs ou événements sportifs facilement.</p>
                        </ion-text>
                        <router-link to="/subscription">
                            <ion-button class="custom-button">Voir les offres</ion-button>
                        </router-link>
                    </ion-col>
                </ion-row>
            </ion-grid>

            <!-- Témoignages -->
            <ion-grid class="testimonials">
                <ion-row class="ion-justify-content-center">
                    <ion-col size="12" size-md="8">
                        <ion-text>
                            <h2>Témoignages</h2>
                        </ion-text>
                        <ion-row class="testimonial-list">
                            <ion-col size="12" size-md="6" class="testimonial-item">
                                <ion-card>
                                    <ion-card-content>
                                        <ion-text>
                                            <p>"Un service incroyable, simple et rapide à utiliser. Je recommande vivement !"</p>
                                            <span>- Lady Dupont</span>
                                        </ion-text>
                                    </ion-card-content>
                                </ion-card>
                            </ion-col>
                            <ion-col size="12" size-md="6" class="testimonial-item">
                                <ion-card>
                                    <ion-card-content>
                                        <ion-text>
                                            <p>"Grâce à cette plateforme, j'ai pu organiser un tournoi facilement. Excellent !"</p>
                                            <span>- Sitan Butterfly</span>
                                        </ion-text>
                                    </ion-card-content>
                                </ion-card>
                            </ion-col>
                            <ion-col size="12" size-md="6" class="testimonial-item">
                                <ion-card>
                                    <ion-card-content>
                                        <ion-text>
                                            <p>"Le meilleur service de réservation de terrains que j'ai utilisé jusqu'à présent."</p>
                                            <span>- Aran Dubois</span>
                                        </ion-text>
                                    </ion-card-content>
                                </ion-card>
                            </ion-col>
                        </ion-row>
                    </ion-col>
                </ion-row>
            </ion-grid>

            <!-- Section À propos -->
            <ion-grid class="about">
                <ion-row class="ion-justify-content-center">
                    <ion-col size="12" size-md="8">
                        <ion-text>
                            <h2>À propos de Nous</h2>
                            <ion-img src="/img/EKIP.jpg" alt="Image de sport"></ion-img>
                            <p>Notre mission est de faciliter l'accès aux terrains de sport et d'encourager la pratique sportive en simplifiant la réservation et l'organisation d'événements.</p>
                        </ion-text>
                    </ion-col>
                </ion-row>
            </ion-grid>

            <!-- Section Actualités -->
            <ion-grid class="news">
                <ion-row class="ion-justify-content-center">
                    <ion-col size="12" size-md="8">
                        <ion-text>
                            <h2>Actualités Sportives</h2>
                            <ion-img src="/img/kiki.jpeg" alt="Image de sport"></ion-img>
                            <p>Restez informés des dernières actualités et événements sportifs. Découvrez les résultats des matchs, les analyses, et bien plus encore sur notre page dédiée.</p>
                        </ion-text>
                        <router-link to="/news">
                            <ion-button class="news-button">Voir les Actualités</ion-button>
                        </router-link>
                    </ion-col>
                </ion-row>
            </ion-grid>

            <!-- Appel à l'Action -->
            <ion-grid class="cta">
                <ion-row class="ion-justify-content-center">
                    <ion-col size="12" size-md="8">
                        <ion-text>
                            <h2>Prêt à Jouer ?
                                "Transformez les défis en opportunités avec nous."
                            </h2>
                            <p>Inscrivez-vous dès maintenant et profitez de nos offres d'abonnement exclusives.</p>
                        </ion-text>
                        <router-link to="/subscription">
                            <ion-button class="cta-button">S'abonner Maintenant</ion-button>
                        </router-link>
                    </ion-col>
                </ion-row>
            </ion-grid>
        </ion-content>
    </ion-page>
</template>

<script setup>
import {
    IonPage,
    IonHeader,
    IonToolbar,
    IonTitle,
    IonContent,
    IonButton,
    IonGrid,
    IonRow,
    IonCol,
    IonText,
    IonImg,
    IonCard,
    IonCardContent
} from "@ionic/vue";
import { RouterLink } from "vue-router";
</script>

<style scoped>
.hero {
    background: linear-gradient(135deg, #c5ccc9, #15854b);
    color: white;
    text-align: center;
    padding: 100px 20px;
    margin-bottom: 20px;
}

.custom-button {
    --background: #268e58;
    --border-radius: 20px;
    --color: #ffffff;
    --padding-start: 20px;
    --padding-end: 20px;
    --transition: background-color 0.3s ease, color 0.3s ease;
}

.hero-content {
    max-width: 800px;
    margin: 0 auto;
}

.hero h1 {
    font-size: 2.5em;
    margin-bottom: 20px;
}

.hero p {
    font-size: 1.2em;
    margin-bottom: 40px;
}

.services, .testimonials, .about, .cta, .news {
    text-align: center;
    padding: 50px 20px;
}

.services h2, .testimonials h2, .about h2, .cta h2, .news h2 {
    font-size: 2em;
    margin-bottom: 20px;
}

.service-list, .testimonial-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.service-item, .testimonial-item {
    margin-bottom: 20px;
    max-width: 600px;
    text-align: center;
}

.service-icon {
    font-size: 3em;
    margin-bottom: 10px;
    color: #15854b;
}

.cta-button, .news-button {
    --background: #0b703c;
    --border-radius: 20px;
    --color: #ffffff;
    --padding-start: 20px;
    --padding-end: 20px;
    --transition: background-color 0.3s ease, color 0.3s ease;
}

ion-card {
    margin: 10px;
}
</style>
