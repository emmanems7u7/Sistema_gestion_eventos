<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inventario;
use Carbon\Carbon;
class InventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            // Cámaras de seguridad
            ['nombre' => 'Cámara Hikvision DS-2CD', 'descripcion' => 'Cámara IP de seguridad con visión nocturna.'],
            ['nombre' => 'Cámara Dahua HFW1200S', 'descripcion' => 'Cámara bullet con resolución Full HD.'],
            ['nombre' => 'Cámara PTZ Sony SNC-EP550', 'descripcion' => 'Cámara PTZ ideal para vigilancia de eventos grandes.'],
            ['nombre' => 'Cámara Axis M2025-LE', 'descripcion' => 'Cámara compacta para exteriores con visión nocturna.'],
            ['nombre' => 'Cámara WiFi TP-Link Tapo C200', 'descripcion' => 'Cámara de monitoreo con conexión inalámbrica.'],
            ['nombre' => 'Cámara Reolink RLC-410', 'descripcion' => 'Cámara PoE con gran angular para interiores.'],
            ['nombre' => 'Cámara Logitech Circle View', 'descripcion' => 'Cámara compatible con HomeKit para vigilancia.'],
            ['nombre' => 'Cámara Blink Outdoor', 'descripcion' => 'Cámara inalámbrica resistente al clima.'],
            ['nombre' => 'Cámara Ezviz C3N', 'descripcion' => 'Cámara con sensor de movimiento y detección de personas.'],
            ['nombre' => 'Cámara Arlo Pro 4', 'descripcion' => 'Cámara 2K con detección inteligente y sirena.'],

            // Equipos de sonido
            ['nombre' => 'Bocina JBL EON615', 'descripcion' => 'Altavoz activo de 1000W ideal para eventos medianos.'],
            ['nombre' => 'Sistema Yamaha StagePas 600BT', 'descripcion' => 'Sistema de sonido portátil con mezcladora.'],
            ['nombre' => 'Bocina Behringer Eurolive B112D', 'descripcion' => 'Altavoz PA con amplificador integrado.'],
            ['nombre' => 'Parlante Bose L1 Compact', 'descripcion' => 'Sistema de columna con excelente claridad.'],
            ['nombre' => 'Altavoz Mackie Thump15A', 'descripcion' => 'Altavoz de 1300W con bajos potentes.'],
            ['nombre' => 'Sistema QSC K12.2', 'descripcion' => 'Parlantes profesionales de alto rendimiento.'],
            ['nombre' => 'Consola Pioneer DJM-750MK2', 'descripcion' => 'Mezcladora de audio para DJs.'],
            ['nombre' => 'Subwoofer Yamaha DXS15', 'descripcion' => 'Subwoofer activo de 15 pulgadas.'],
            ['nombre' => 'Micrófono Shure SM58', 'descripcion' => 'Micrófono vocal legendario para presentaciones.'],
            ['nombre' => 'Sistema inalámbrico Sennheiser EW 100 G4', 'descripcion' => 'Micrófono inalámbrico profesional.'],

            // Pantallas y proyectores
            ['nombre' => 'Pantalla LED Samsung 55" 4K', 'descripcion' => 'Pantalla UHD ideal para presentaciones visuales.'],
            ['nombre' => 'Pantalla LG UHD 65UN7100', 'descripcion' => 'Televisor de 65 pulgadas con gran ángulo de visión.'],
            ['nombre' => 'Pantalla Sony Bravia X80J', 'descripcion' => 'Pantalla 4K con soporte HDR.'],
            ['nombre' => 'Pantalla TCL 50" Serie 5', 'descripcion' => 'Pantalla con Roku integrada para proyección multimedia.'],
            ['nombre' => 'Pantalla Hisense A6G 55"', 'descripcion' => 'Ideal para proyecciones de video en eventos.'],
            ['nombre' => 'Pantalla portátil de proyección 120"', 'descripcion' => 'Pantalla plegable para uso con proyector.'],
            ['nombre' => 'Proyector Epson PowerLite X49', 'descripcion' => 'Proyector versátil con HDMI y USB.'],
            ['nombre' => 'Proyector BenQ TH671ST', 'descripcion' => 'Proyector Full HD de corto alcance.'],
            ['nombre' => 'Proyector Optoma HD146X', 'descripcion' => 'Proyector ideal para entornos con poca luz.'],
            ['nombre' => 'Proyector LG PF50KA', 'descripcion' => 'Proyector portátil con batería integrada.'],
            ['nombre' => 'Proyector ViewSonic PA503W', 'descripcion' => 'Modelo confiable para uso frecuente en eventos.'],

            // Extras combinados
            ['nombre' => 'Pantalla interactiva SmartBoard MX265', 'descripcion' => 'Pantalla táctil para presentaciones interactivas.'],
            ['nombre' => 'Cámara GoPro HERO10', 'descripcion' => 'Cámara de acción para grabaciones dinámicas.'],
            ['nombre' => 'Cámara Canon Vixia HF R800', 'descripcion' => 'Cámara de video compacta y profesional.'],
            ['nombre' => 'Sistema de sonido portátil Ion Block Rocker Plus', 'descripcion' => 'Bocina con batería para uso móvil.'],
            ['nombre' => 'Bocina portátil Bose S1 Pro', 'descripcion' => 'Bocina Bluetooth con entrada para micrófono.'],
            ['nombre' => 'Pantalla curva Samsung 49"', 'descripcion' => 'Ideal para visualización panorámica.'],
            ['nombre' => 'Cámara Nikon D7500', 'descripcion' => 'Cámara DSLR para fotos y videos de eventos.'],
            ['nombre' => 'Micrófono inalámbrico Rode Wireless GO II', 'descripcion' => 'Micrófono compacto y profesional.'],
            ['nombre' => 'Pantalla para exteriores 75" resistente al agua', 'descripcion' => 'Pantalla para eventos al aire libre.'],


            ['nombre' => 'Uniforme seguridad táctico', 'descripcion' => 'Uniforme resistente y funcional para personal de seguridad en exteriores.'],
            ['nombre' => 'Uniforme seguridad formal', 'descripcion' => 'Vestimenta elegante y profesional para guardias en ambientes corporativos.'],
            ['nombre' => 'Botas de seguridad', 'descripcion' => 'Calzado con punta de acero y suela antideslizante para protección.'],
            ['nombre' => 'Chaleco antibalas liviano', 'descripcion' => 'Protección balística de nivel básico, cómodo para uso prolongado.'],
            ['nombre' => 'Linterna táctica recargable', 'descripcion' => 'Iluminación potente para rondas nocturnas, resistente al agua.'],
            ['nombre' => 'Radio comunicador UHF', 'descripcion' => 'Comunicación eficiente para coordinación del equipo de seguridad.'],
            ['nombre' => 'Cinturón táctico multipropósito', 'descripcion' => 'Accesorio para portar herramientas de seguridad y defensa.'],
            ['nombre' => 'Cámara corporal (body cam)', 'descripcion' => 'Dispositivo de grabación para respaldo visual de incidentes.'],
            ['nombre' => 'Detector de metales portátil', 'descripcion' => 'Herramienta para control de acceso y prevención de ingreso de objetos peligrosos.'],
            ['nombre' => 'Guantes tácticos antiderrapantes', 'descripcion' => 'Protección de manos con agarre firme y resistencia a impactos.'],

            ['nombre' => 'Uniforme limpieza institucional', 'descripcion' => 'Ropa cómoda y resistente para personal de limpieza en oficinas.'],
            ['nombre' => 'Zapatos antideslizantes', 'descripcion' => 'Calzado especial para evitar resbalones en superficies mojadas.'],
            ['nombre' => 'Guantes de látex', 'descripcion' => 'Protección de manos contra productos químicos y suciedad.'],
            ['nombre' => 'Carro de limpieza multiuso', 'descripcion' => 'Estructura con compartimientos para transportar implementos de aseo.'],
            ['nombre' => 'Mopa industrial con balde escurridor', 'descripcion' => 'Sistema de limpieza eficiente para grandes superficies.'],
            ['nombre' => 'Pulverizador de líquidos', 'descripcion' => 'Herramienta para aplicar desinfectantes de forma uniforme.'],
            ['nombre' => 'Mascarilla facial desechable', 'descripcion' => 'Protección básica contra polvo y partículas durante la limpieza.'],
            ['nombre' => 'Lentes de protección transparente', 'descripcion' => 'Evita salpicaduras de productos químicos en los ojos.'],
            ['nombre' => 'Delantal impermeable', 'descripcion' => 'Prenda que protege el cuerpo del contacto con líquidos.'],
            ['nombre' => 'Toallas y paños de microfibra', 'descripcion' => 'Accesorios para limpieza sin dejar pelusa ni rayar superficies.'],

            ['nombre' => 'Uniforme mesero clásico', 'descripcion' => 'Vestimenta formal en blanco y negro para atención en restaurantes.'],
            ['nombre' => 'Mandil largo negro', 'descripcion' => 'Accesorio elegante para proteger la ropa durante el servicio.'],
            ['nombre' => 'Zapatos cómodos de servicio', 'descripcion' => 'Calzado profesional para largas jornadas sin fatiga.'],
            ['nombre' => 'Camisa blanca manga larga', 'descripcion' => 'Parte del uniforme estándar para meseros en eventos formales.'],
            ['nombre' => 'Pantalón negro de vestir', 'descripcion' => 'Prenda esencial del uniforme de atención al cliente.'],
            ['nombre' => 'Moño o corbata para mesero', 'descripcion' => 'Complemento que aporta distinción al uniforme.'],
            ['nombre' => 'Porta cuentas de mano', 'descripcion' => 'Accesorio para entregar cuentas de forma ordenada y elegante.'],
            ['nombre' => 'Pañuelo de servicio', 'descripcion' => 'Usado para presentación o manipulación higiénica de utensilios.'],
            ['nombre' => 'Guantes blancos para eventos', 'descripcion' => 'Uso en servicios de alto protocolo o atención VIP.'],
            ['nombre' => 'Gorra o boina de mesero', 'descripcion' => 'Complemento que completa el uniforme según estilo del local.']

        ];


        foreach ($items as $item) {
            Inventario::create([
                'nombre' => $item['nombre'],
                'descripcion' => $item['descripcion'],
                'cantidad_disponible' => rand(2, 20),
                'categoria' => 'Evento',
                'frecuencia_mantenimiento' => 'Mensual',
                'fecha_adquisicion' => Carbon::now()->subMonths(rand(1, 24)),
                'estado' => 1,
            ]);
        }
    }
}
