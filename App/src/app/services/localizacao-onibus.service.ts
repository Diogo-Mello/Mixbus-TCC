import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import { EnderecoService } from './endereco.service';


@Injectable({
  providedIn: 'root'
})
export class LocalizacaoOnibusService {

  constructor(
    private http: HttpClient,
    private EnderecoService: EnderecoService
  ) { }

  private URL = this.EnderecoService.endereco+"api/localizacaolinha?pass=mixbus123api";

  localizacaoOnibus(): Observable<any> {
    return this.http.get<any>(this.URL);
  }
}
