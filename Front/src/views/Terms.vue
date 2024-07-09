<template>
    <ion-page>
        <ion-header>
            <ion-toolbar>
                <ion-buttons slot="start">
                    <ion-back-button defaultHref="/"></ion-back-button>
                </ion-buttons>
                <ion-title>CGU / CGV</ion-title>
            </ion-toolbar>
        </ion-header>
        <ion-content>
            <ion-card>
                <ion-card-header>
                    <ion-card-title
                        >Conditions Générales d'Utilisation /
                        Vente</ion-card-title
                    >
                </ion-card-header>
                <ion-card-content>
                    <p>
                        <strong>1. Préambule :</strong><br />
                        Les présentes Conditions Générales d'Utilisation et de
                        Vente (CGU/CGV) régissent l'utilisation du site de
                        réservation de terrains sportifs ainsi que les
                        conditions de vente des services proposés.
                    </p>
                    <p>
                        <strong>2. Acceptation des conditions :</strong><br />
                        En accédant et en utilisant le site, l'utilisateur
                        accepte sans réserve les présentes CGU/CGV.
                    </p>
                    <p>
                        <strong>3. Utilisation du site :</strong><br />
                        L'utilisateur s'engage à utiliser le site de manière
                        conforme aux lois et règlements en vigueur, ainsi qu'aux
                        présentes CGU/CGV.
                    </p>
                    <p>
                        <strong>4. Réservation :</strong><br />
                        Les réservations de terrains sportifs se font via le
                        formulaire de réservation en ligne. L'utilisateur
                        recevra une confirmation par e-mail après validation de
                        la réservation.
                    </p>
                    <p>
                        <strong>5. Tarifs et paiements :</strong><br />
                        Les tarifs des services sont indiqués sur le site. Le
                        paiement s'effectue en ligne via une plateforme
                        sécurisée.
                    </p>
                    <p>
                        <strong>6. Annulation :</strong><br />
                        Toute annulation doit être effectuée au moins 24 heures
                        avant la date prévue de la réservation pour pouvoir
                        prétendre à un remboursement.
                    </p>
                    <p>
                        <strong>7. Responsabilité :</strong><br />
                        L'entreprise ne peut être tenue pour responsable des
                        dommages directs ou indirects résultant de l'utilisation
                        du site.
                    </p>
                </ion-card-content>
            </ion-card>
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
    IonCard,
    IonCardHeader,
    IonCardTitle,
    IonCardContent,
    IonButtons,
    IonBackButton,
} from "@ionic/vue";
</script>

<style scoped>
ion-card {
    --background: #f8f9fa;
    margin: 16px;
}

ion-card-title {
    font-size: 1.5em;
    color: #495057;
}

ion-card-content p {
    font-size: 1em;
    color: #6c757d;
    margin-bottom: 1.5em;
}
</style>
