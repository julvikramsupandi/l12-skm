import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbSeparator,
} from "@/components/ui/breadcrumb"
import { Link, Head } from "@inertiajs/react"
import AppLayout from "@/layouts/app-layout"
import { Skm } from "@/types"
import SkmListCard from "./components/SkmListCard"
import { useMemo, useState } from "react"
import { InputGroup, InputGroupAddon, InputGroupInput } from "@/components/ui/input-group"
import { SearchIcon } from "lucide-react"

interface SkmPageProps {
    title: string,
    skms: Skm[],
}

export default function SkmPage({ title, skms }: SkmPageProps) {

    const [search, setSearch] = useState("")

    const filteredSkms = useMemo(() => {
        if (!search) return skms

        return skms.filter((skm) =>
            skm.unor.name
                .toLowerCase()
                .includes(search.toLowerCase())
        )
    }, [search, skms])


    return (
        <AppLayout>
            <Head title={title} />
            <div className="mb-5">
                <h1 className="text-3xl font-serif font-bold mb-1">
                    Organisasi Pemerintah Daerah
                </h1>
                <span className="text-sm text-muted-foreground line-clamp-2">
                    Daftar Organisasi Pemerintah Daerah yang telah terdaftar dalam Aplikasi Survei Kepuasan Masyarakat
                </span>

                <div className="mt-5">
                    <Breadcrumb>
                        <BreadcrumbList>
                            <BreadcrumbItem>
                                <BreadcrumbLink asChild>
                                    <Link>Beranda</Link>
                                </BreadcrumbLink>
                            </BreadcrumbItem>
                            <BreadcrumbSeparator />
                            <BreadcrumbItem>
                                <BreadcrumbLink asChild>
                                    <Link className="text-foreground">Organisasi Pemerintah Daerah</Link>
                                </BreadcrumbLink>
                            </BreadcrumbItem>
                        </BreadcrumbList>
                    </Breadcrumb>
                </div>
            </div>

            <InputGroup className="mb-5 rounded-lg">
                <InputGroupInput
                    placeholder="Cari Organisasi Pemerintah Daerah"
                    value={search}
                    onChange={(e) => setSearch(e.target.value)}
                />
                <InputGroupAddon>
                    <SearchIcon className="text-primary" />
                </InputGroupAddon>
                <InputGroupAddon align="inline-end">{filteredSkms.length} Hasil</InputGroupAddon>
            </InputGroup>

            <SkmListCard skms={filteredSkms} />

        </AppLayout>
    )
}
