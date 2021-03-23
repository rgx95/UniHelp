/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Semi {
    static get denari () { return 0; };
    static get spade () { return 1; };
    static get coppe () { return 2; };
    static get bastoni () { return 3; };
    static isSemi(s) { return ((0 <= s && s <= 3) && (typeof s === "number")) ? true : false; };
}

class Carta {
  constructor(v, s){
      this._valore = (1 <= v && v <= 10) ? v : -1;
      this._seme = (Semi.isSemi(s)) ? s : -1;
      if (this._valore === -1 || this._seme === -1) throw {name:"Carta()->constructor(v, s)", message:"invalid arguments"};
  }
  
  get valore() { return this._valore; }
  get seme() { return this._seme; }
  
  toString() { 
    let seme = "";
    if (this._seme === Semi.denari) seme = "Denari";
    if (this._seme === Semi.spade) seme = "Spade";
    if (this._seme === Semi.coppe) seme = "Coppe";
    if (this._seme === Semi.bastoni) seme = "Bastoni";
    return this._valore + " di " + seme;
  }
  
  set valore(v) { return this._valore = (1 <= v && v <= 10) ? v : -1; }
  set seme(s) { return this._seme = (Semi.isSemi(s)) ? s : -1; }
  
  static isCarta(c) {
      if (c === undefined)
          return false;
      if (typeof c !== "object")
          return false;
      if (c._valore !== undefined && c._seme !== undefined)
          return true;
      return false;
  }
}

class Mazzo {
    constructor(nome, arr) {
        this._nome = (nome) ? nome : "mazzo_generico";
        this._carte = (Array.isArray(arr)) ? arr : [];
    }
    get nome() { return this._nome; }
    get carte() { return this._carte; }
    get lunghezza() { return this._carte.length; }
    set nome(n) { return this._nome = (n) ? n : "mazzo_generico"; }
    set carte(arr) { return this._carte = (Array.isArray(arr)) ? arr : []; }
    
    static isMazzo(m) {
        if (m === undefined)
            return false;
        if (typeof m !== "object")
            return false;
        if ((m._nome !== undefined) && Array.isArray(m.carte) && (m._lunghezza !== undefined))
            return true;
        return false;
    }
    
    // aggiungi carta al mazzo in due modi
    aggiungiSopra (c) { 
        if (!Carta.isCarta(c)) throw {name:"Mazzo()->aggiungiSopra(c)", message:"invalid argument, typeof is not Carta() " };
        return this._carte.push(c);
    }
    aggiungiSotto (c) { 
        if (!Carta.isCarta(c)) throw {name:"Mazzo()->aggiungiSopra(c)", message:"invalid argument, typeof is not Carta() " };
        return this._carte.unshift(c);
    }
    
    // pesca carta dal mazzo, in tre modi diversi
    pescaDaSopra () { 
        if (this._carte.length === 0) throw {name:"Mazzo()->pescaDaSopra()", message:"empty array" };
        return this._carte.pop();
    }
    pesca (n) { 
        if (this._carte.length === 0) throw {name:"Mazzo()->pesca(vn)", message:"empty array" };
        if (!(0 <= n && n <= this._carte.length - 1)) throw {name:"Mazzo()->pesca(n)", message:"invalid argument n, not in range" };
        let c = this._carte[n];
        this._carte.splice(n, 1);
        return c;
    }
    pescaDaSotto () { 
        if (this._carte.length === 0) throw {name:"Mazzo()->pescaDaSotto()", message:"empty array" };
        return this._carte.shift();
    }
    
    mescola () {
        for(let i = this._carte.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * i)
            const temp = this._carte[i]
            this._carte[i] = this._carte[j]
            this._carte[j] = temp
        }
    }
}

class Briscola {
    constructor () {
        this._mazzo = new Mazzo("mazzo");
        
        for(let i=0; i<40; i++) {
            let valore = (i%10) + 1;
            let seme = Math.floor(i/10);
            this._mazzo.aggiungiSopra(new Carta(valore, seme));
        }
        
        this._mazzo.mescola();
    
        this._mazzoGiocatore1 = new Mazzo("giocatore1");
        this._mazzoGiocatore2 = new Mazzo("giocatore2");

        for(let i=0; i<3; i++) {
            this._mazzoGiocatore1.aggiungiSopra(this._mazzo.pescaDaSopra());
            this._mazzoGiocatore2.aggiungiSopra(this._mazzo.pescaDaSopra());
        }

        this._ultimaCarta = this._mazzo.pescaDaSopra();
        this._briscola = this._ultimaCarta.seme;
        this._aTerra = new Mazzo("terra");
    }
    
    get mazzo() { return this._mazzo; };
    get aTerra() { return this._aTerra; };
    get mazzoGiocatore1() { return this._mazzoGiocatore1; };
    get mazzoGiocatore2() { return this._mazzoGiocatore2; };
    get ultimaCarta() { return this._ultimaCarta; };
    get briscola() { return this._briscola; };
    
    set mazzo(x) { return this._mazzo = (Mazzo.isMazzo(x)) ? x : this._mazzo ; };
    set aTerra(x) { return this._aTerra = (Mazzo.isMazzo(x) && x.lunghezza <= 2) ? x : this._aTerra ; };
    set mazzoGiocatore1(x) { return this._mazzoGiocatore1 = (Mazzo.isMazzo(x) && x.lunghezza <= 3) ? x : this._mazzoGiocatore1 ; };
    set mazzoGiocatore2(x) { return this._mazzoGiocatore2 = (Mazzo.isMazzo(x) && x.lunghezza <= 3) ? x : this._mazzoGiocatore2 ; };
    set ultimaCarta(x) { return this._ultimaCarta = (Carta.isCarta(x)) ? x : this._ultimaCarta ; };
    set briscola(x) { return this._briscola = (Carta.isCarta(x)) ? x : this._briscola ; };
    
    static isBriscola(b) {
        if (b === undefined)
            return false;
        if (typeof b !== "object")
            return false;
        if ((b._mazzo !== undefined) && (b._aTerra !== undefined) && (b._mazzoGiocatore1 !== undefined) && (b._mazzoGiocatore2 !== undefined) && (b._ultimaCarta !== undefined) && (b._briscola !== undefined))
            return true;
        return false; 
    }
}

/*
class Briscola3 extends Briscola {
}

class Briscola4 extends Briscola {
}

class Briscola5 extends Briscola {
}
*/


function leggiGet(parameterName) {
    var result = null,
        tmp = [];
    location.search
        .substr(1)
        .split("&")
        .forEach(function (item) {
          tmp = item.split("=");
          if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]) ;
        });
    return result;
}

function unisciti(l) {console.log("mi unisco a stanza "+l)}
function crea(p) {console.log("creo stanza per "+p)}