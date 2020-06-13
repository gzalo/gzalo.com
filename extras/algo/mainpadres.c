#include <stdio.h>
#include <stdlib.h>
#include <string.h>  //NOTAR QUE USO LA BIBLIOTECA string.h

typedef struct persona{
	char nombre[20];
	char antecesor[20];
	struct persona *sig;
}tPersona;

/***********************************************************
FUNCIONES NECESARIAS PARA CUMPLIR CON LO PEDIDO*************
***********************************************************/

void InsertarHijo(tPersona** lista, tPersona* hijo)
{
    if(*lista == NULL){
        *lista = (tPersona*) malloc(sizeof(tPersona));
        strcpy((*lista)->nombre, hijo->nombre);
        strcpy((*lista)->antecesor, hijo->antecesor);
        (*lista)->sig = NULL;
    }
    else{InsertarHijo(&((*lista)->sig), hijo);}
}

tPersona* CrearListaPadreYsusHijos(tPersona* listaHijos, tPersona* padre)
{
    tPersona* nuevaLista = NULL;
    nuevaLista = (tPersona*) malloc(sizeof(tPersona));
    strcpy(nuevaLista->nombre, padre->nombre);
    nuevaLista->sig = NULL;
    tPersona* aux = listaHijos;
    for(; aux!=NULL; aux=aux->sig){
        if(strcmp(aux->antecesor,padre->nombre)==0){
            InsertarHijo(&nuevaLista, aux);
        }
    }
    return nuevaLista;
}

tPersona* SaltarAfinal(tPersona* lista)
{
    tPersona* aux = lista;
    for(;aux->sig != NULL; aux=aux->sig);
    return aux;
}

void Unir(tPersona **padres, tPersona **hijos)
{
    tPersona* padreActual=*padres;
    tPersona* padreSig=(*padres)->sig;
    tPersona* listEndMarker;
    *padres = CrearListaPadreYsusHijos(*hijos, padreActual);
    free(padreActual);
    padreActual=NULL;
    listEndMarker = SaltarAfinal(*padres);
    listEndMarker->sig = padreSig;
    if(padreSig != NULL)
        Unir(&(listEndMarker->sig), hijos);
}

void LiberarHijos(tPersona** lista)
{
    tPersona* elemSig=(*lista)->sig;
    free(*lista);
    *lista = NULL;
    if(elemSig != NULL)
        LiberarHijos(&elemSig);
}

void enganchar(tPersona **padres, tPersona **hijos)
{
    Unir(padres, hijos);
    LiberarHijos(hijos);
}

/***********************************************************
FUNCIONES PARA PROBAR EL PROGRAMA***************************
***********************************************************/

void InsertarPadre(tPersona** lista)
{
    if(*lista == NULL){
        *lista = (tPersona*) malloc(sizeof(tPersona));
        printf("Ingrese nombre del padre.");
        fgets((*lista)->nombre, 19, stdin);
        fflush(stdin);
        (*lista)->sig = NULL;
    }
    else{InsertarPadre(&((*lista)->sig));}
}

void CrearListaPadres(tPersona** padres)
{
    int i, cantPa;
    printf("Ingrese cant. de padres.");
    scanf("%d", &cantPa);
    fflush(stdin);
    for(i=0; i<cantPa; i++){
        InsertarPadre(padres);
    }
}

void InsertarHijoBis(tPersona** lista)
{
    if(*lista == NULL){
        *lista = (tPersona*) malloc(sizeof(tPersona));
        printf("Ingrese nombre del hijo.");
        fgets((*lista)->nombre, 19, stdin);
        fflush(stdin);
        printf("Ingrese nombre del antecesor.");
        fgets((*lista)->antecesor, 19, stdin);
        fflush(stdin);
        (*lista)->sig = NULL;
    }
    else{InsertarHijoBis(&((*lista)->sig));}
}

void CrearListaHijos(tPersona** hijos)
{
    int i, cantHi;
    printf("Ingrese cant. de hijos.");
    scanf("%d", &cantHi);
    fflush(stdin);
    for(i=0; i<cantHi; i++){
        InsertarHijoBis(hijos);
    }
}

void ImprimirListaPadres(tPersona* lista)
{
    tPersona* aux = lista;
    for(; aux != NULL; aux=aux->sig){
        printf("%s", aux->nombre);
    }
}

void ImprimirListaHijos(tPersona* lista)
{
    tPersona* aux = lista;
    for(; aux != NULL; aux=aux->sig){
        printf("%s", aux->nombre);
        printf("%s", aux->antecesor);
    }
}

/***********************************************************
FUNCION MAIN************************************************
***********************************************************/

int main()
{
    tPersona* padres = NULL;
    tPersona* hijos = NULL;
    CrearListaPadres(&padres);
    CrearListaHijos(&hijos);
    ImprimirListaPadres(padres);
    ImprimirListaHijos(hijos);
    enganchar(&padres, &hijos);
    ImprimirListaPadres(padres);
    return 0;
}
