<template>
    <ion-page>
        <ion-header>
            <ion-toolbar>
                <ion-title>Mentions Légales</ion-title>
            </ion-toolbar>
        </ion-header>
        <ion-content class="ion-padding">
            <ion-card>
                <ion-card-header>
                    <ion-card-title>Mentions Légales</ion-card-title>
                </ion-card-header>
                <ion-card-content>
                    <p>
                        <strong>Propriétaire du site : Alex</strong><br />Nom de
                        l'entreprise : MARACANA<br />Adresse de l'entreprise : **********<br />Numéro de
                        téléphone : ******************<br />Adresse e-mail: **********<br />
                    </p>

                    <p>
                        <strong>Propriété intellectuelle :</strong><br />Tous
                        les contenus présents sur ce site sont la propriété
                        exclusive de l'entreprise, sauf mention contraire. Toute
                        reproduction, distribution, modification, adaptation,
                        retransmission ou publication, même partielle, de ces
                        différents éléments est strictement interdite sans
                        l'accord exprès par écrit de l'entreprise.
                    </p>
                    <p>
                        <strong>Responsabilité :</strong><br />L'entreprise met
                        tout en œuvre pour offrir aux utilisateurs des
                        informations et/ou outils disponibles et vérifiés, mais
                        ne saurait être tenue pour responsable des erreurs,
                        d'une absence de disponibilité des informations et/ou de
                        la présence de virus sur son site.
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
