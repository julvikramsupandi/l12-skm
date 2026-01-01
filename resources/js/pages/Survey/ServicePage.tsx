import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbSeparator,
} from "@/components/ui/breadcrumb"
import { InputGroup, InputGroupAddon, InputGroupInput } from "@/components/ui/input-group"
import { Link, Head } from "@inertiajs/react"
import AppLayout from "@/layouts/app-layout"
import { Service, Skm } from "@/types"
import ServiceListCard from "./components/ServiceListCard"
import { useMemo, useState } from "react"
import { SearchIcon } from "lucide-react"

interface ServicePageProps {
    title: string,
    uuid: string,
    services: Service[],
    skm: Skm
}

export default function ServicePage({ title, uuid, services, skm }: ServicePageProps) {

    const [search, setSearch] = useState("")

    const filteredServices = useMemo(() => {
        if (!search) return services

        return services.filter((service) =>
            service.name
                .toLowerCase()
                .includes(search.toLowerCase())
        )
    }, [search, services])

    return (
        <AppLayout>
            <Head title={title} />
            <div className="mb-5">
                <h1 className="text-3xl font-serif font-bold mb-1">
                    {skm.unor.name}
                </h1>
                <span className="text-sm text-muted-foreground line-clamp-2">
                    {skm.unor.address}
                </span>

                <div className="mt-5">
                    <Breadcrumb>
                        <BreadcrumbList>
                            <BreadcrumbItem>
                                <BreadcrumbLink >
                                    <Link>Beranda</Link>
                                </BreadcrumbLink>
                            </BreadcrumbItem>
                            <BreadcrumbSeparator />
                            <BreadcrumbItem>
                                <BreadcrumbLink asChild>
                                    <Link href={route('survey')}>Organisasi Pemerintah Daerah</Link>
                                </BreadcrumbLink>
                            </BreadcrumbItem>
                            <BreadcrumbSeparator />
                            <BreadcrumbItem>
                                <BreadcrumbLink asChild>
                                    <Link className="text-foreground">Layanan</Link>
                                </BreadcrumbLink>
                            </BreadcrumbItem>
                        </BreadcrumbList>
                    </Breadcrumb>
                </div>
            </div>

            <InputGroup className="mb-5 rounded-lg">
                <InputGroupInput
                    placeholder="Cari layanan"
                    value={search}
                    onChange={(e) => setSearch(e.target.value)}
                />
                <InputGroupAddon>
                    <SearchIcon className="text-primary" />
                </InputGroupAddon>
                <InputGroupAddon align="inline-end">{filteredServices.length} Hasil</InputGroupAddon>
            </InputGroup>

            <ServiceListCard
                uuid={uuid}
                services={filteredServices}
            />

        </AppLayout>
    )
}
