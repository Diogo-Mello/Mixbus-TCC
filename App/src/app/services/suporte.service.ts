import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { EnderecoService } from './endereco.service';

export interface Suporte{
  id: number
}

export interface PedidoSuporte{
  descricao: string,
  fkUsuario: number
}

@Injectable({
  providedIn: 'root'
})

export class SuporteService {

  constructor(
    private http: HttpClient,
    private EnderecoService: EnderecoService
  ) { }

  private URL = this.EnderecoService.endereco+"api/listarsuporteapp?pass=mixbus123api";
  private URL2 = this.EnderecoService.endereco+"api/pedidosuporteapp?pass=mixbus123api";

  suporte(suporte: Suporte): Observable<Suporte> {
    return this.http.post<Suporte>(this.URL, suporte);
  }

  pedidoSuporte(suporte: PedidoSuporte): Observable<PedidoSuporte> {
    return this.http.post<PedidoSuporte>(this.URL2, suporte)
  }
}
